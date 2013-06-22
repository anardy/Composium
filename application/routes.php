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

Route::get('minharea', function() {
	$cpf = Auth::user()->cpf;
	$userinscrito = Inscricao::busca_inscricao($cpf);
	$verificapgto = Inscricao::user_pagou($cpf);
	$horario = Programacao::gerar_horario_user($cpf);
	$controle_presenca = Presenca::buscar_presenca($cpf);
	$reinscricao = Reinscricao::get_reinscricao_user($cpf);

	foreach ($verificapgto as $d) {
        $user_pagou = $d->status;
    }

    $nrouser_presencauser = Presenca::nrouser_presencauser($cpf);
    $nrototal_user = Presenca::nrototal_user($cpf);

    if ($nrototal_user > 0) {
    	$media_user = ($nrouser_presencauser * 100)/$nrototal_user;
    } else {
    	$media_user = 0;
    }

    if (!isset($user_pagou)) {
    	$user_pagou = NULL;
    }
    if (!isset($reinscricao)) {
    	$reinscricao = 0;
    }
	return View::make('account.area')->with('userinscrito', $userinscrito)->with('horario', $horario)->with('user_pagou', $user_pagou)->with('media_user',$media_user)->with('controle_presenca',$controle_presenca)->with('reinscricao', $reinscricao);
});

Route::post('reinscricao', function() {
	Reinscricao::inserir_reinscricao(Auth::user()->cpf);
	return "<h4>Sua Reinscrição foi enviada com sucesso!!</h4>
        	<p>Assim que sua Reinscrição for autorizada você receberá um e-mail para realizar a Inscrição novamente</p>
        	<p>Dúvidas entre em contato: composium@unifei.edu.com.br</p>
        	<p>Obrigado,</p>
        	<p>Equipe de Organização do III Composium</p>";
});

Route::get('certificado', function() {
	return View::make('account.certificados');
});

Route::get('artigo', function() {
	$msgm = Session::get('artigo');
	return View::make('account.artigo')->with('msgm', $msgm);
});

Route::post('enviarArtigo', function() {
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
});

Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('/');
});

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

Route::get('iniciarinscricao', function() {
	$users = Programacao::teste('2012-04-16');
	return View::make('inscricao.primeirodiaInscricao')->with('users',$users);
});

Route::post('cadPrimeirodia', function() {
	$segunda14 = Input::get('2012-04-1614:00');
	$users = Programacao::teste('2012-04-17');
	return View::make('inscricao.segundodiaInscricao')->with('users',$users)->with('segunda14',$segunda14);
});

Route::post('cadSegundodia', function() {
	$users = Programacao::teste('2012-04-18');
	return View::make('inscricao.terceirodiaInscricao')->with('users',$users);
});

Route::post('cadTerceirodia', function() {
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
			Presenca::inserir_presenca($cpf, $all_palestras[$i]);
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

	Inscricao::inserir_inscricao($cpf, $total);

	$nome_minicurso = Presenca::buscar_presenca($cpf);

	return View::make('inscricao.confirmacaoInscricao')->with('total', $total)->with('minicursos', $nome_minicurso)->with('taxa', $precoTaxa)->with('mnicrs', $precoMiniCurso);
});

Route::get('meudados', function() {
	$results = Cadastro::get_dados(Auth::user()->cpf);
	return View::make('account.dados')->with('results', $results);
});

Route::get('boleto', function() {
	return View::make('inscricao.boleto');
});

Route::get('RH', function() {
	return View::make('perfis.rh.home');
});

Route::get('controlePresenca', function() {
	$palestras = Programacao::get_palestra();
	$array = array();
	foreach($palestras as $p) {
		$array[$p->abreviacao] = $p->abreviacao.' - '.$p->nome;
	}
	return View::make('perfis.rh.presenca')->with('palestras',$array);
});

Route::post('listarParticipantes', function() {
	$participantes = Presenca::lista_participantes(Input::get('abreviacao'));
	return View::make('perfis.rh.participantes')->with('participantes', $participantes);
});

Route::get('foraLista', function() {
	$palestras = Programacao::get_palestra();
	$array = array();
	foreach($palestras as $p) {
		$array[$p->abreviacao] = $p->abreviacao.' - '.$p->nome;
	}
	return View::make('perfis.rh.foralista')->with('palestras',$array);
});

Route::post('insUserPalestra', function() {
	$cpf = Input::get('cpf');
	$abreviacao = Input::get('abreviacao');
	$valida_cpf = Cadastro::get_valida($cpf);
	if ($valida_cpf > 0) {
		Presenca::inserir_presenca($cpf, $abreviacao);
		return "Inscrição realizada com sucesso!";
	} else {
		return "CPF inválido! Tente novamente com outro CPF.";
	}
});

Route::get('listaPresenca', function() {
	$palestras = Programacao::get_palestra();
	$array = array();
	foreach($palestras as $p) {
		$array[$p->abreviacao] = $p->abreviacao.' - '.$p->nome;
	}
	return View::make('perfis.rh.listapresenca')->with('palestras',$array);
});

Route::post('gerarListaPresenca', function() {
	$abreviacao = Input::get('abreviacao');
	$participantes = Presenca::lista_presenca($abreviacao);
	$info_palestras = Programacao::get_infoPalestras($abreviacao);
	return View::make('perfis.rh.Listaparticipantes')->with('participantes', $participantes)->with('info_palestras',$info_palestras);
});

Route::get('autReinscricao', function() {
	$reinscricoes = Reinscricao::get_reinscricoes();

	return View::make('perfis.rh.reinscricao')->with('reinscricoes', $reinscricoes);
});

Route::post('autReinscricao', function() {
	$teste = Input::get('reinscricao');

	foreach ($teste as $u) {
		Reinscricao::autoriza_reinscricao($u);
		Inscricao::excluir_inscricao($u);
		Presenca::excluir_presenca($u);
	}
	return Redirect::to('autReinscricao');
});

Route::get('voluntarios', function() {
	return View::make('perfis.rh.voluntarios');
});

Route::get('pagamento', function() {
	$registros = Inscricao::busca_pgto_cpf(Input::get('cpf'));

	$query = Session::get('cu');
	return View::make('perfis.rh.pagamento')->with('registros',$registros)->with('cu', $query);
});

Route::post('pagamento', function() {
	$registros = Inscricao::busca_pgto_cpf(Input::get('cpf'));
$query = Session::get('cu');
	return View::make('perfis.rh.pagamento')->with('registros', $registros)->with('cu', $query);
});

Route::post('estoutestando', function() {
	Session::put('cu', 'caralho');
	$cpf = Input::get('cpf');
	Inscricao::confirma_pgto_user($cpf);
	return Redirect::to('pagamento');
});

Route::get('usuarios', function() {
	$registros = Inscricao::busca_cpf(Input::get('cpf'));

	return View::make('perfis.rh.usuarios')->with('registros', $registros);
});

Route::get('Administrador', function() {
	return View::make('perfis.admin.home');
});

Route::get('manutencao', function() {
	return View::make('perfis.admin.manutencao');
});

Route::get('logs', function() {
	return View::make('perfis.admin.log');
});

Route::get('cadPerfil', function() {
	return View::make('perfis.admin.cadPerfil');
});

Route::get('conPerfil', function() {
	return View::make('perfis.admin.conPerfil');
});

Route::get('altPerfil', function() {
	return View::make('perfis.admin.altPerfil');
});

Route::get('remPerfil', function() {
	return View::make('perfis.admin.remPerfil');
});

Route::post('cadPerfil', function() {
	$new_date = array(
		'cpf' => Input::get('cpf'),
		'perfil' => Input::get('perfil')
		);

	$regras = array('cpf' => 'required');

	$v = Validator::make($new_date, $regras);

	if ($v->fails()) {
		return Redirect::to('cadPerfil')->with_errors($v)->with_input();
	}

	Perfil::inserir_perfil($new_date);
	return Redirect::to('cadPerfil');
});

Route::post('conPerfil', function() {
	$cpf = Input::get('cpf');

	$perfis = Perfil::eh_admin($cpf);

	foreach ($perfis as $p) {
		$perfil = $p->perfil;
	}

	if (isset($perfil)) {
		return 'O perfil procurado é: '.$perfil;
	} else {
		return 'Perfil não encontrado! Tente novamente com outro CPF.';
	}
});

Route::post('altPerfil', function() {
	$cpf = Input::get('cpf');
	$perfil = Input::get('perfil');

	$perfis = Perfil::eh_admin($cpf);

	foreach ($perfis as $p) {
		$eh_admin = $p->perfil;
	}

	if (isset($eh_admin)) {
		Perfil::alterar_perfil($cpf,$perfil);
		return 'Perfil alterado com sucesso.';
	} else {
		return 'Tente novamente com outro CPF.';
	}
});

Route::post('remPerfil', function() {
	$cpf = Input::get('cpf');

	$perfis = Perfil::eh_admin($cpf);

	foreach ($perfis as $p) {
		$perfil = $p->perfil;
	}

	if (isset($perfil)) {
		Perfil::remover_perfil($cpf);
		return 'Perfil removido com sucesso';
	} else {
		return 'Perfil não encontrado! Tente novamente com outro CPF.';
	}
});

Route::get('Coordenador', function() {
	return View::make('perfis.coordenador.home');
});

Route::get('Revisor', function() {
	$all_artigos = Artigo::get_all_artigos();
	$total_artigos = Artigo::get_artigos_total();
	return View::make('perfis.revisor')->with('artigos', $all_artigos)->with('total_artigos', $total_artigos);
});

Route::get('Voluntario', function() {
	return View::make('perfis.voluntario');
});