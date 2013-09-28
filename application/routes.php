<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

Route::get('/', function() {
	$users = Programacao::teste('2012-04-16');
	$segundo = Programacao::teste('2012-04-17');
	$terceiro = Programacao::teste('2012-04-18');

	if (Auth::check()) {
		$admin = Perfil::eh_admin(Auth::user()->cpf);
		foreach ($admin as $a) {
	        $perfil = $a->perfil;
	    }
    }
    if (!isset($perfil)) {
    		$perfil = NULL;
    }

	return View::make('home.teste')->with('users',$users)->with('segundo',$segundo)->with('terceiro',$terceiro)->with('perfil',$perfil);
});

Route::get('help', function() {
	return View::make('home.index');
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) 
		return Response::error('500');
});

Route::filter('auth', function() {
    if (Auth::guest()) return Redirect::to('/');
});

Route::get('login', function() {
    return View::make('account.home');
});

Route::post('login', function() {
	$userdata = array(
			'username' => Input::get('cpf'),
			'password' => Input::get('password')
		);

	if (Auth::attempt($userdata)) {
		return Redirect::to('minharea');
	} else {
		return Redirect::to('login')->with('login_errors', true);
	}
});

Route::get('minharea', array('before' => 'auth', 'do' => function() {
	$cpf = Auth::user()->cpf;
	$user_pagou = Inscricao::user_pagou($cpf);
	$horario = Programacao::gerar_horario_user($cpf);

	return View::make('account.area')
	->with('horario', $horario)
	->with('user_pagou', $user_pagou);
}));

Route::get('notificacao', function() {
	return View::make('account.notificacao');
});

Route::get('notificacaoRh', function() {
	return View::make('perfis.rh.notificacao');
});

Route::get('notificacaoVoluntario', function() {
	return View::make('perfis.voluntario.notificacao');
});

Route::get('notificacaoRevisor', function() {
	return View::make('perfis.revisor.notificacao');
});

Route::get('notificacaoAdmin', function() {
	return View::make('perfis.admin.notificacao');
});

Route::get('notificacaoCoordenador', function() {
	return View::make('perfis.coordenador.notificacao');
});

Route::get('reinscricao', function() {
	$cpf = Auth::user()->cpf;
	$reinscricao = Reinscricao::get_reinscricao_user($cpf);
	return View::make('account.reinscricao')
	->with('reinscricao', $reinscricao);
});

Route::post('reinscricao', array('before' => 'auth', 'do' => function() {
	Reinscricao::inserir_reinscricao(Auth::user()->cpf);
	$notificacao = array(
			'perfil' => 'rh',
			'mensagem' => '8'
		);
	Notificacao::inserir_notificacao($notificacao);
	return "<h4>Sua Reinscrição foi enviada com sucesso!!</h4>
        	<p>Assim que sua Reinscrição for autorizada você receberá um e-mail para realizar a Inscrição novamente</p>
        	<p>Dúvidas entre em contato: composium@unifei.edu.com.br</p>
        	<p>Obrigado,</p>
        	<p>Equipe de Organização do III Composium</p>";
}));

Route::get('certificado', array('before' => 'auth', 'do' => function() {
	$cpf =  Auth::user()->cpf;
	$certificados = Presenca::get_certificados($cpf);
	$total_presenca_user = Presenca::nrouser_presencauser($cpf);
	$total_user = Presenca::nrototal_user($cpf);
	return View::make('account.certificados')
	->with('certificados', $certificados)
	->with('total_presenca_user', $total_presenca_user)
	->with('total_user', $total_user);
}));

Route::get('certParticipacao', array('before' => 'auth', 'do' => function() {
	
	$headers = array('Content-Type' => 'application/pdf');
$pdf = new Fpdf();
	$pdf = new FPDF( 'P','cm','A4' );
	$pdf->Open();
	$pdf->AddPage();

	//$pdf->Image('images/LogoEFEI.jpg',3,5,15,15,jpg);

	$pdf->SetFont('Arial','',29);
	$pdf->SetMargins(0,0,0);
	$pdf->setY("3.0");
	$pdf->setX("6.1");
	$pdf->Cell(0, 0, "CERTIFICADO");

	$pdf->SetFont('Arial','',15);
	$pdf->setY("7.0");
	$pdf->setX("2.1");
	$pdf->Cell(0, 0, "Certificamos que");

	$pdf->SetFont('Arial','',15);
	$pdf->setY("9.0");
	$pdf->setX("3.5");
	$pdf->Cell(0, 0, utf8_decode('André Mack Nardy'));

	$pdf->SetFont('Arial','',15);
	$pdf->setY("11.0");
	$pdf->setX("2.0");
	$pdf->Multicell(18, 0.8, "participou do II Composium ~ " . utf8_decode('Simpósio') . " de " . utf8_decode('Computação') . " 2012, realizado em" . utf8_decode('Itajubá') . ", de 16 a 18 de abril na UNIFEI - Universidade Federal de " . utf8_decode('Itajubá'));

	//$pdf->Image('images/assinatura.png',9,15.4,3.5,1,png);

	$pdf->SetFont('Arial','',15);
	$pdf->setY("16.0");
	$pdf->setX("6.5");
	$pdf->Cell(0, 0, "____________________________");

	$pdf->SetFont('Arial','',13);
	$pdf->setY("16.5");
	$pdf->setX("7.8");
	$pdf->Multicell(18, 0.8, "Coordenador II Composium");



//	$pdf->Image('images/certificado.png',2,2,3,2,png);

	$pdf->Output("certificado","I");

	return Response::make($pdf->Output(), 200, $headers);
}));

Route::get('presenca', array('before' => 'auth', 'do' => function() {
	$cpf = Auth::user()->cpf;
	$controle_presenca = Presenca::buscar_presenca($cpf);
	$nrouser_presencauser = Presenca::nrouser_presencauser($cpf);
    $nrototal_user = Presenca::nrototal_user($cpf);

    if ($nrototal_user > 0) {
    	$media_user = ($nrouser_presencauser * 100)/$nrototal_user;
    } else {
    	$media_user = 0;
    }

	return View::make('account.presenca')
	->with('controle_presenca',$controle_presenca)
	->with('media_user',round($media_user));
}));

Route::get('artigo', array('before' => 'auth', 'do' => function() {
	$msgm = Session::get('artigo');
	return View::make('account.artigo')->with('msgm', $msgm);
}));

Route::post('enviarArtigo', array('before' => 'auth', 'do' => function() {
	$cpf = Auth::user()->cpf;
	$titulo = Input::get('titulo');
	$autores = Input::get('autores');
	$resumo = Input::get('resumo');
	$palavrachave = Input::get('palavrachave');
	$artigo = Input::get('artigo');

	$new_date = array(
		'titulo' => $titulo,
		'autores' => $autores,
		'resumo' => $resumo,
		'palavrachave' => $palavrachave,
		'artigo' => $artigo
	);

	$regras = array(
		'titulo' => 'required',
		'autores' => 'required',
		'resumo' => 'required',
		'palavrachave' => 'required',
		'artigo' => 'mimes:pdf'
		);

	$v = Validator::make($new_date, $regras);

	if ($v->fails()) {
		return Redirect::to('artigo')->with_errors($v)->with_input();
	}

	$filename = $cpf.'.pdf';
	Artigo::inserir_artigo($cpf, $titulo, $autores, $resumo, $palavrachave, $filename);
    Input::upload('artigo', 'public/artigos', $filename);
    Session::put('artigo', 'enviado');
	return Redirect::to('artigo');
}));

Route::get('logout', array('before' => 'auth', 'do' => function() {
	Auth::logout();
	return Redirect::to('/');
}));

Route::get('logar', function() {
    return View::make('account.home')->with('praonde','index');
});

Route::get('inscricao', function() {
 if (Auth::user()) {
    $userinscrito = Inscricao::busca_inscricao(Auth::user()->cpf);
      return View::make('inscricao.home')->with('userinscrito', $userinscrito);
    } else {
      return View::make('account.home');
    }
});

Route::post('cadDadosPessoais', function() {
	$new_date = array(
		'firstnome' => Input::get('firstnome'),
		'lastnome' => Input::get('lastnome'),
		'senha' => Hash::make(Input::get('senha')),
		'cpf' => Input::get('cpf'),
		'matricula' => Input::get('matricula'),
		'email' => Input::get('email'),
		'instituicao' => Input::get('instituicao'),
		'curso' => Input::get('curso'),
		'ano' => Input::get('ano'),
		'periodo' => Input::get('periodo')
		);

	$regras = array(
		'firstnome' => 'required',
		'lastnome' => 'required',
		'senha' => 'required',
		'cpf' => 'required',
		'email' => 'required',
		'ano' => 'required',
		'periodo' => 'required'
		);

	$v = Validator::make($new_date, $regras);

	if ($v->fails()) {
		return Redirect::to('inscricao')->with_errors($v)->with_input();
	}

	$cadastro = new Cadastro($new_date);
	$cadastro->save();

	$userdata = array(
			'username' => Input::get('cpf'),
			'password' => Input::get('senha')
		);

	Auth::attempt($userdata);

	$praonde = Input::get('praonde');
	
	if (!isset($praonde)) {
    	return Redirect::to('inscricao');
    } else {
    	return Redirect::to('/');
    }
});

Route::post('altDadosPessoais', array('before' => 'auth', 'do' => function() {
	$new_date = array(
		'firstnome' => Input::get('firstnome'),
		'lastnome' => Input::get('lastnome'),
		'matricula' => Input::get('matricula'),
		'email' => Input::get('email'),
		'instituicao' => Input::get('instituicao'),
		'curso' => Input::get('curso'),
		'ano' => Input::get('ano'),
		'periodo' => Input::get('periodo')
		);

	$regras = array(
		'firstnome' => 'required',
		'lastnome' => 'required',
		'email' => 'required',
		'ano' => 'required',
		'periodo' => 'required'
		);

	$v = Validator::make($new_date, $regras);

	if ($v->fails()) {
		return Redirect::to('meudados')->with_errors($v)->with_input();
	}

	Cadastro::atualizar_dados(Auth::user()->cpf, $new_date);

	return Redirect::to('meudados');
}));

Route::get('iniciarinscricao', array('before' => 'auth', 'do' => function() {
	$users = Programacao::teste('2012-04-16');
	return View::make('inscricao.primeirodiaInscricao')->with('users',$users);
}));

Route::post('cadPrimeirodia', array('before' => 'auth', 'do' => function() {
	$segunda14 = Input::get('2012-04-1614:00');
	$users = Programacao::teste('2012-04-17');
	return View::make('inscricao.segundodiaInscricao')->with('users',$users)->with('segunda14',$segunda14);
}));

Route::post('cadSegundodia', array('before' => 'auth', 'do' => function() {
	$users = Programacao::teste('2012-04-18');
	return View::make('inscricao.terceirodiaInscricao')->with('users',$users);
}));

Route::post('cadTerceirodia', array('before' => 'auth', 'do' => function() {
	$minicursos = array();

	$all_palestras = array(
		Input::get('opSeg9'),
		Input::get('opSeg10'),
		Input::get('opSeg14'),
		Input::get('opSeg16'),
		Input::get('opSeg18'),
		Input::get('opSeg19'),
		Input::get('opSeg20'),
		Input::get('opTer10'),
		str_replace('-',' - ',Input::get('opTer14')),
		Input::get('opTer16'),
		str_replace('-',' - ',Input::get('opTer19')),
		Input::get('opTer20'),
		Input::get('2012-04-1809:00'),
		Input::get('2012-04-1810:30'),
		Input::get('2012-04-1814:00')
		);

	$contaminicuros = 0;
	$precoMiniCurso = 0;
	$precoTaxa = 0;
	$cpf = Auth::user()->cpf;

	for ($i = 0, $len = sizeof($all_palestras); $i < $len; $i++) {
		if (substr($all_palestras[$i], 0, 1) == "M") {
			$contaminicuros++;
			array_push($minicursos, $all_palestras[$i]);
		}
		if (!empty($all_palestras[$i])) {
			//Presenca::inserir_presenca($cpf, $all_palestras[$i]);
		}
	}

	$users = Cadastro::pesquisa_usuario_calculo($cpf);
	foreach ($users as $user) {
		$instituicao = $user->instituicao;
		$curso = $user->curso;
	}

	if (($instituicao == 'UNIFEI') || ($instituicao == 'ITABIRA')) {
		if (($curso == 'CCO') || ($curso == 'ECO') || ($curso == 'SIN')) {
			$precoMiniCurso = 10;
		} else {
			$precoMiniCurso = 20;
		}
		$precoTaxa = 5;
	} else if ($instituicao == 'OUTRA') {
		$precoTaxa = 30;
		$precoMiniCurso = 20;
	}

	$total = (((int) $contaminicuros * (int) $precoMiniCurso)+(int)$precoTaxa);

	//Inscricao::inserir_inscricao($cpf, $total);

	$nome_minicurso = Presenca::buscar_presenca($cpf);

	return View::make('inscricao.confirmacaoInscricao')->with('total', $total)->with('minicursos', $nome_minicurso)->with('taxa', $precoTaxa)->with('mnicrs', $precoMiniCurso);
}));

Route::get('meudados', array('before' => 'auth', 'do' => function() {
	$results = Cadastro::get_dados(Auth::user()->cpf);
	return View::make('account.dados')->with('results', $results);
}));

Route::get('voluntario', array('before' => 'auth', 'do' => function() {
	return View::make('account.voluntario');
}));

Route::post('cadVoluntario', array('before' => 'auth', 'do' => function() {
	$new_date = array(
		'cpf' => Auth::user()->cpf,
		'primeiraopcao' => Input::get('primeiraopcao'),
		'segundaopcao' => Input::get('segundaopcao'),
		'terceiraopcao' => Input::get('terceiraopcao'),
		'status' => '0'
		);

	Voluntario::inserir_voluntario($new_date);
	Reinscricao::inserir_reinscricao(Auth::user()->cpf);
	$notificacao = array(
			'perfil' => 'rh',
			'mensagem' => '9'
		);
	Notificacao::inserir_notificacao($notificacao);
	return Redirect::to('voluntario');
}));


Route::get('boleto', array('before' => 'auth', 'do' => function() {
	$cpf = Auth::user()->cpf;
	$result = Cadastro::get_nome($cpf);
	$total = Inscricao::get_valor($cpf);

	return View::make('inscricao.boleto')
	->with('total', $total[0]->valor)
	->with('result', $result);
}));

Route::get('RH', array('before' => 'auth', 'do' => function() {
	return View::make('perfis.rh.home')
	->with('c_voluntarios', Voluntario::count_voluntarios())
	->with('c_reinscricao', Reinscricao::count_reinscricao())
	->with('c_users', Cadastro::count_users())
	->with('ultimos_users', Cadastro::ultimos_users())
	->with('ultimas_realizacoes', Realizacao::ultimas_realizacoes(Auth::user()->cpf));
}));

Route::get('controlePresenca', array('before' => 'auth', 'do' => function() {
	$palestras = Programacao::get_palestra();
	$array = array();
	foreach($palestras as $p) {
		$array[$p->abreviacao] = $p->abreviacao.' - '.$p->nome;
	}
	return View::make('perfis.rh.presenca')->with('palestras',$array);
}));

Route::post('listarParticipantes', array('before' => 'auth', 'do' => function() {
	$participantes = Presenca::lista_participantes(Input::get('abreviacao'));
	$palestra = Programacao::get_infoPalestras(Input::get('abreviacao'));

	return View::make('perfis.rh.participantes')
	->with('participantes', $participantes)
	->with('palestra', $palestra);
}));

Route::post('atuPresenca', array('before' => 'auth', 'do' => function() {
	$participantes = Input::get('participantes');
	$abreviacao = Input::get('abreviacao');

	$todos = Presenca::get_all_cpfs($abreviacao);

	$foram = array();
	$naoforam = array();

	foreach ($participantes as $u) {
		array_push($foram, $u);
	}

	foreach ($todos as $u) {
		array_push($naoforam, $u->cpf);
	}

	foreach ($naoforam as $key => $t) {
		foreach ($foram as $key2 => $u) {
			if ($t == $u) {
				unset($naoforam[$key]);
			}
		}
	}
	$realizacao_nok = array();
	foreach ($naoforam as $u) {
		Presenca::atualizar_presenca_nok($u, $abreviacao);
		$realizacao_nok[] = array(
			'quem' => Auth::user()->cpf,
			'oque' => 'Removeu presença do usuário ' . $u . ' da ' . $abreviacao
		);
	}
	Realizacao::inserir_realizacao($realizacao_nok);
	$realizacao_ok = array();
	foreach ($foram as $u) {
		Presenca::atualizar_presenca_ok($u, $abreviacao);
		$realizacao_ok[] = array(
			'quem' => Auth::user()->cpf,
			'oque' => 'Lançou presença do usuário ' . $u . ' para ' . $abreviacao
		);
	}
	Realizacao::inserir_realizacao($realizacao_ok);
	
	return Redirect::to('controlePresenca');
}));

Route::get('imprimirListaPresenca/(:any)', array('before' => 'auth', 'do' => function($abreviacao) {
	$participantes = Presenca::lista_participantes($abreviacao);
	$palestra = Programacao::get_infoPalestras($abreviacao);
	return View::make('perfis.rh.Listaparticipantes')
	->with('participantes',$participantes)
	->with('palestra',$palestra);
}));

Route::get('foraLista', array('before' => 'auth', 'do' => function() {
	$palestras = Programacao::get_palestra();
	$array = array();
	foreach($palestras as $p) {
		$array[$p->abreviacao] = $p->abreviacao.' - '.$p->nome;
	}
	return View::make('perfis.rh.foralista')->with('palestras',$array);
}));

Route::post('insUserPalestra', array('before' => 'auth', 'do' => function() {
	$cpf = Input::get('cpf');
	$abreviacao = Input::get('abreviacao');
	$valida_cpf = Cadastro::get_valida($cpf);
	if ($valida_cpf > 0) {
		Presenca::inserir_presenca($cpf, $abreviacao);
		return "Inscrição realizada com sucesso!";
	} else {
		return "CPF inválido! Tente novamente com outro CPF.";
	}
}));

Route::get('autReinscricao', array('before' => 'auth', 'do' => function() {
	$reinscricoes = Reinscricao::get_reinscricoes();

	return View::make('perfis.rh.reinscricao')->with('reinscricoes', $reinscricoes);
}));

Route::post('buscaAutReinscricao', array('before' => 'auth', 'do' => function() {
	$reinscricoes = Reinscricao::busca_reinscricoes(Input::get('nome'));
	return View::make('perfis.rh.reinscricao')
	->with('reinscricoes', $reinscricoes);
}));

Route::post('autReinscricao', array('before' => 'auth', 'do' => function() {
	$teste = Input::get('reinscricao');
	$notificacao = array();
	$realizacao = array();
	foreach ($teste as $u) {
		Reinscricao::autoriza_reinscricao($u);
		Inscricao::excluir_inscricao($u);
		Presenca::excluir_presenca($u);
		 $notificacao[] = array(
			'destinatario' => $u,
			'perfil' => 'usuario',
			'mensagem' => '1'
		);
		$realizacao[] = array(
			'quem' => Auth::user()->cpf,
			'oque' => 'Autorizou a reinscrição do usuário ' . $u
		);
	}
	Notificacao::inserir_notificacao($notificacao);
	Realizacao::inserir_realizacao($realizacao);
	return Redirect::to('autReinscricao');
}));

Route::get('voluntarios', array('before' => 'auth', 'do' => function() {
	$voluntarios = Voluntario::get_voluntarios();
	return View::make('perfis.rh.voluntarios')->with('voluntarios', $voluntarios);
}));

Route::post('autVoluntario', array('before' => 'auth', 'do' => function() {
	$teste = Input::get('cpfs');
	$voluntario = array();
	$realizacao = array();
	foreach ($teste as $u) {
		Voluntario::autoriza_voluntario($u);
		$new_date = array(
			'destinatario' => $u,
			'perfil' => 'usuario',
			'mensagem' => '3'
		);
		$voluntario[] = array(
			'cpf' => $u,
			'perfil' => 'Voluntario'
		);
		$realizacao[] = array(
			'quem' => Auth::user()->cpf,
			'oque' => 'Credenciou o usuário ' . $u . ' como Voluntário'
		);
	}
	Realizacao::inserir_realizacao($realizacao);
	Notificacao::inserir_notificacao($new_date);
	Perfil::inserir_perfil($voluntario);
	return Redirect::to('voluntarios');
}));

Route::get('pagamento', array('before' => 'auth', 'do' => function() {
	$registros = Inscricao::busca_pgto_cpf(Input::get('cpf'));

	$query = Session::get('cu');
	return View::make('perfis.rh.pagamento')->with('registros',$registros)->with('cu', $query);
}));

Route::post('pagamento', array('before' => 'auth', 'do' => function() {
	$registros = Inscricao::busca_pgto_cpf(Input::get('cpf'));
	$query = Session::get('cu');
	return View::make('perfis.rh.pagamento')->with('registros', $registros)->with('cu', $query);
}));

Route::post('estoutestando', array('before' => 'auth', 'do' => function() {
	Session::put('cu', 'caralho');
	$cpf = Input::get('cpf');
	$new_date = array(
		'destinatario' => $cpf,
		'perfil' => 'usuario',
		'mensagem' => '5'
		);
	$realizacao = array(
		'quem' => Auth::user()->cpf,
		'oque' => 'Realizou o pagamento do usuário ' . $cpf
		);
	Inscricao::confirma_pgto_user($cpf);
	Notificacao::inserir_notificacao($new_date);
	Realizacao::inserir_realizacao($realizacao);
	return Redirect::to('pagamento');
}));

Route::get('usuarios', array('before' => 'auth', 'do' => function() {
	$registros = Inscricao::busca_cpf(Input::get('cpf'));
	return View::make('perfis.rh.usuarios')->with('registros', $registros);
}));

Route::post('usuarios', array('before' => 'auth', 'do' => function() {
	$registros = Inscricao::busca_cpf(Input::get('cpf'));
	return View::make('perfis.rh.usuarios')->with('registros', $registros);
}));

Route::get('controleVagas', array('before' => 'auth', 'do' => function() {
	$palestras = Programacao::get_palestra();
	$array = array();
	foreach($palestras as $p) {
		$array[$p->abreviacao] = $p->abreviacao.' - '.$p->nome;
	}
	$topvagas = Programacao::get_topvagas();
	return View::make('perfis.rh.vagas')
	->with('palestras',$array)
	->with('topvagas', $topvagas);
}));

Route::get('logs', array('before' => 'auth', 'do' => function() {
	return View::make('perfis.admin.log');
}));

Route::get('galeria', array('before' => 'auth', 'do' => function() {
	return View::make('perfis.admin.galeria');
}));

/* Rotas do Perfil Administrador */
Route::controller('administrador');
Route::get('administrador', array('as' => 'manutencao', 'before' => 'auth', 'uses' => 'administrador@administrador'));
Route::get('administrador/manutencao', array('as' => 'manutencao', 'before' => 'auth', 'uses' => 'administrador@manutencao'));
Route::get('administrador/programacao', array('as' => 'programacao', 'before' => 'auth', 'uses' => 'administrador@programacao'));
Route::any('administrador/perfis', array('as' => 'perfis', 'before' => 'auth', 'uses' => 'administrador@perfis'));
Route::any('administrador/CadPerfil', array('as' => 'CadPerfil', 'before' => 'auth', 'uses' => 'administrador@CadPerfil'));
Route::any('administrador/AltPerfil/(:any)/(:any)', array('as' => 'AltPerfil', 'before' => 'auth', 'uses' => 'administrador@AltPerfil'));
Route::get('administrador/RemPerfil/(:any)/(:any)', array('as' => 'AltPerfil', 'before' => 'auth', 'uses' => 'administrador@RemPerfil'));
Route::any('administrador/usuarios', array('as' => 'usuarios', 'before' => 'auth', 'uses' => 'administrador@usuarios'));
Route::get('administrador/ConUsuario/(:any)', array('as' => 'ConUsuario', 'before' => 'auth', 'uses' => 'administrador@ConUsuario'));
Route::get('administrador/RemUsuario/(:any)', array('as' => 'RemUsuario', 'before' => 'auth', 'uses' => 'administrador@RemUsuario'));
/* Fim Rotas do Perfil Administrador */

Route::get('Coordenador', array('before' => 'auth', 'do' => function() {
	return View::make('perfis.coordenador.home')
	->with('c_voluntarios', Voluntario::count_voluntarios())
	->with('c_artigos', Artigo::count_artigos())
	->with('c_users', Cadastro::count_users())
	->with('c_pagantes', Inscricao::count_pagantes());
}));

Route::get('Revisor', array('before' => 'auth', 'do' => function() {
	$all_artigos = Artigo::get_all_artigos();
	$msgm = Session::get('revisorartigo');
	return View::make('perfis.revisor.home')
	->with('msgm', $msgm)
	->with('artigos', $all_artigos);
}));

Route::post('aprovarartigo', array('before' => 'auth', 'do' => function() {
	Artigo::aprovar_artigo(Input::get('cpf'));
	Session::put('revisorartigo', 'aprovado');
	return Redirect::to('Revisor');
}));

Route::get('conArtigo/(:any)', array('before' => 'auth', 'do' => function($cpf) {
	if (isset($cpf)) {
		$results = Artigo::get_artigo($cpf);
		return View::make('perfis.revisor.conArtigo')->with('results', $results);
	}
}));

Route::get('Voluntario', array('before' => 'auth', 'do' => function() {
	return View::make('perfis.voluntario.voluntario');
}));

Route::get('Inscricoes', array('before' => 'auth', 'do' => function() {
	$porcurso = Cadastro::grafico_porcuros();
	$porinstuicao = Cadastro::grafico_porinstituicao();
	$maisprocurados = Presenca::get_maisprocurados();
	return View::make('perfis.coordenador.inscricoes')
	->with('porcurso', $porcurso)
	->with('porinstuicao', $porinstuicao)
	->with('maisprocurados', $maisprocurados);
}));

Route::get('Vagas', array('before' => 'auth', 'do' => function() {
	$palestras = Programacao::get_palestra();
	$array = array();
	foreach($palestras as $p) {
		$array[$p->abreviacao] = $p->abreviacao.' - '.$p->nome;
	}
	$topvagas = Programacao::get_topvagas();
	return View::make('perfis.coordenador.vagas')
	->with('palestras',$array)
	->with('topvagas', $topvagas);
}));

Route::get('Contabilidade', array('before' => 'auth', 'do' => function() {
	return View::make('perfis.coordenador.contabilidade')
	->with('emcaixa', Inscricao::get_emcaixa())
	->with('areceber', Inscricao::get_areceber());
}));

Route::get('Presencas', array('before' => 'auth', 'do' => function() {
	$total = Presenca::get_total();
	$mediaPresentes = (Presenca::get_all_presentes()/$total)*100;
	$mediaAusentes = (Presenca::get_all_ausentes()/$total)*100;
	if ($mediaPresentes > $mediaAusentes) {
		$texto = "It's Good!!";
	} else {
		$texto = "It's Bad!";
	}
	$palestras = Programacao::get_palestra();
	$array = array();
	foreach($palestras as $p) {
		$array[$p->abreviacao] = $p->abreviacao.' - '.$p->nome;
	}
	$dados = Presenca::get_graph();
	return View::make('perfis.coordenador.presencas')
	->with('palestras',$array)
	->with('dados', json_encode($dados))
	->with('mediaPresentes', round($mediaPresentes))
	->with('mediaAusentes', round($mediaAusentes))
	->with('texto', $texto);
}));

Route::post('controleVagas', array('before' => 'auth', 'do' => function() {
	$abreviacao = Input::get('abreviacao');
	$texto = null;
	if ($abreviacao == 'all') {
		$vagas = Programacao::get_topvagas();
	} else {
		$vagas = Programacao::get_vagas($abreviacao);
		$texto = "Vagas Restantes";
	}
	return View::make('perfis.coordenador.controlevagas')
	->with('vagas', $vagas)
	->with('texto', $texto);
}));

Route::get('controleArtigos', array('before' => 'auth', 'do' => function() {
	$all_artigos = Artigo::get_all_artigos();
	$msgm = Session::get('revisorartigo');
	return View::make('perfis.rh.artigos')
	->with('msgm', $msgm)
	->with('artigos', $all_artigos);
}));

Route::post('gerarPresenca', array('before' => 'auth', 'do' => function() {
	$abreviacao = Input::get('abreviacao');
	if ($abreviacao == 'all') {
		$dados = Presenca::get_bestpresenca();
		return View::make('perfis.coordenador.controlepresencatop10')
		->with('dados', $dados);
	} else {
		$presentes = Presenca::get_presentes($abreviacao);
		$ausentes = Presenca::get_ausentes($abreviacao);
		$total = Presenca::nrototal_abreviacao($abreviacao);
		$percentual = ($presentes * 100)/$total;
		return View::make('perfis.coordenador.controlepresenca')
		->with('presentes', $presentes)
		->with('ausentes', $ausentes)
		->with('percentual', round($percentual));
	}
}));

Route::get('Orcamento', array('before' => 'auth', 'do' => function() {
	return View::make('perfis.coordenador.orcamento');
}));

Route::get('controleArtigosCoord', array('before' => 'auth', 'do' => function() {
	$all_artigos = Artigo::get_all_artigos();
	$msgm = Session::get('revisorartigo');
	return View::make('perfis.coordenador.artigos')
	->with('msgm', $msgm)
	->with('artigos', $all_artigos);
}));