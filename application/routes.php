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
		$perfil = Perfil::eh_admin(Auth::user()->cpf);
    }
    if (!isset($perfil)) {
    		$perfil = NULL;
    }

	return View::make('home.index')->with('users',$users)->with('segundo',$segundo)->with('terceiro',$terceiro)->with('perfil',$perfil);
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

Route::filter('before', function() {
	// Do stuff before every request to your application...
});

Route::filter('after', function($response) {
	// Do stuff after every request to your application...
});

Route::filter('csrf', function() {
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
		return Redirect::to_action('Minharea@Minharea');
	} else {
		return Redirect::to('login')->with('login_errors', true);
	}
});

Route::get('logout', array('as' => 'logout', 'uses' => 'home@logout'));

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

	Inscricao::inserir_inscricao($cpf, $total);

	$nome_minicurso = Presenca::buscar_presenca($cpf);

	return View::make('inscricao.confirmacaoInscricao')->with('total', $total)->with('minicursos', $nome_minicurso)->with('taxa', $precoTaxa)->with('mnicrs', $precoMiniCurso);
}));

/*
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
*/

/* Rotas do Perfil Administrador */
Route::controller('administrador');
Route::get('Administrador', array('as' => 'Administrador', 'before' => 'auth', 'uses' => 'Administrador@Administrador'));
Route::any('administrador/manutencao', array('as' => 'manutencao', 'before' => 'auth', 'uses' => 'administrador@manutencao'));
Route::get('administrador/programacao', array('as' => 'programacao', 'before' => 'auth', 'uses' => 'administrador@programacao'));
Route::any('administrador/perfis', array('as' => 'perfis', 'before' => 'auth', 'uses' => 'administrador@perfis'));
Route::any('administrador/CadPerfil', array('as' => 'CadPerfil', 'before' => 'auth', 'uses' => 'administrador@CadPerfil'));
Route::any('administrador/AltPerfil/(:any)/(:any)', array('as' => 'AltPerfil', 'before' => 'auth', 'uses' => 'administrador@AltPerfil'));
Route::get('administrador/RemPerfil/(:any)/(:any)', array('as' => 'RemPerfil', 'before' => 'auth', 'uses' => 'administrador@RemPerfil'));
Route::any('administrador/usuarios', array('as' => 'usuarios', 'before' => 'auth', 'uses' => 'administrador@usuarios'));
Route::get('administrador/ConUsuario/(:any)', array('as' => 'ConUsuario', 'before' => 'auth', 'uses' => 'administrador@ConUsuario'));
Route::get('administrador/RemUsuario/(:any)', array('as' => 'RemUsuario', 'before' => 'auth', 'uses' => 'administrador@RemUsuario'));
Route::get('administrador/galeria', array('as' => 'galeria', 'before' => 'auth', 'uses' => 'administrador@galeria'));
Route::get('administrador/notificacao', array('as' => 'notificacao', 'before' => 'auth', 'uses' => 'administrador@notificacao'));
/* Fim Rotas do Perfil Administrador */

/* Rotas do Perfil Coordenador */
Route::controller('coordenador');
Route::get('Coordenador', array('as' => 'Coordenador', 'before' => 'auth', 'uses' => 'Coordenador@Coordenador'));
Route::any('coordenador/vagas', array('as' => 'vagas', 'before' => 'auth', 'uses' => 'coordenador@vagas'));
Route::get('coordenador/inscricoes', array('as' => 'inscricoes', 'before' => 'auth', 'uses' => 'coordenador@inscricoes'));
Route::any('coordenador/presencas', array('as' => 'presencas', 'before' => 'auth', 'uses' => 'coordenador@presencas'));
Route::get('coordenador/contabilidade', array('as' => 'contabilidade', 'before' => 'auth', 'uses' => 'coordenador@contabilidade'));
Route::get('coordenador/orcamento', array('as' => 'orcamento', 'before' => 'auth', 'uses' => 'coordenador@orcamento'));
Route::get('coordenador/artigos', array('as' => 'artigos', 'before' => 'auth', 'uses' => 'coordenador@artigos'));
Route::get('coordenador/notificacao', array('as' => 'notificacao', 'before' => 'auth', 'uses' => 'coordenador@notificacao'));
/* Fim Rotas do Perfil Coordenador */

/* Rotas da Minha Área */
Route::controller('minharea');
Route::get('Minharea', array('as' => 'Minharea', 'before' => 'auth', 'uses' => 'Minhaarea@Minharea'));
Route::get('minharea/boleto', array('as' => 'boleto', 'before' => 'auth', 'uses' => 'minharea@boleto'));
Route::any('minharea/reinscricao', array('as' => 'reinscricao', 'before' => 'auth', 'uses' => 'minharea@reinscricao'));
Route::get('minharea/meusdados', array('as' => 'meusdados', 'before' => 'auth', 'uses' => 'minharea@meusdados'));
Route::post('minharea/AltDados', array('as' => 'AltDados', 'before' => 'auth', 'uses' => 'minharea@AltDados'));
Route::any('minharea/artigo', array('as' => 'artigo', 'before' => 'auth', 'uses' => 'minharea@artigo'));
Route::get('minharea/presenca', array('as' => 'presenca', 'before' => 'auth', 'uses' => 'minharea@presenca'));
Route::get('minharea/certificado', array('as' => 'certificado', 'before' => 'auth', 'uses' => 'minharea@certificado'));
Route::any('minharea/voluntario', array('as' => 'voluntario', 'before' => 'auth', 'uses' => 'minharea@voluntario'));
Route::get('minharea/notificacao', array('as' => 'notificacao', 'before' => 'auth', 'uses' => 'minharea@notificacao'));
Route::get('minharea/teste', array('as' => 'teste', 'before' => 'auth', 'uses' => 'minharea@teste'));
/* Fim Rotas do Minha Área */

/* Rotas do Perfil RH */
Route::controller('rh');
Route::get('RH', array('as' => 'RH', 'before' => 'auth', 'uses' => 'RH@RH'));
Route::any('rh/pagamento', array('as' => 'pagamento', 'before' => 'auth', 'uses' => 'rh@pagamento'));
Route::post('rh/efetuarpagamento', array('as' => 'efetuarpagamento', 'before' => 'auth', 'uses' => 'rh@efetuarpagamento'));
Route::any('rh/presenca', array('as' => 'presenca', 'before' => 'auth', 'uses' => 'rh@presenca'));
Route::post('rh/listapresenca', array('as' => 'listapresenca', 'before' => 'auth', 'uses' => 'rh@listapresenca'));
Route::get('rh/imprimirlistapresenca', array('as' => 'imprimirlistapresenca', 'before' => 'auth', 'uses' => 'rh@imprimirlistapresenca'));
Route::any('rh/voluntarios', array('as' => 'voluntarios', 'before' => 'auth', 'uses' => 'rh@voluntarios'));
Route::any('rh/usuarios', array('as' => 'usuarios', 'before' => 'auth', 'uses' => 'rh@usuarios'));
Route::get('rh/artigos', array('as' => 'artigos', 'before' => 'auth', 'uses' => 'rh@artigos'));
Route::any('rh/vagas', array('as' => 'vagas', 'before' => 'auth', 'uses' => 'rh@vagas'));
Route::any('rh/reinscricao', array('as' => 'reinscricao', 'before' => 'auth', 'uses' => 'rh@reinscricao'));
Route::post('rh/autorizareinscricao', array('as' => 'autorizareinscricao', 'before' => 'auth', 'uses' => 'rh@autorizareinscricao'));
Route::get('rh/notificacao', array('as' => 'notificacao', 'before' => 'auth', 'uses' => 'rh@notificacao'));
/* Fim Rotas do Perfil RH */

/* Rotas do Perfil Revisor */
Route::controller('revisor');
Route::get('Revisor', array('as' => 'Revisor', 'before' => 'auth', 'uses' => 'Revisor@Revisor'));
Route::post('revisor/aprovarartigo', array('as' => 'aprovarartigo', 'before' => 'auth', 'uses' => 'revisor@aprovarartigo'));
Route::get('revisor/ConArtigo/(:any)', array('as' => 'ConArtigo', 'before' => 'auth', 'uses' => 'revisor@ConArtigo'));
Route::get('revisor/notificacao', array('as' => 'notificacao', 'before' => 'auth', 'uses' => 'revisor@notificacao'));
Route::post('revisor/reprovarartigo', array('as' => 'reprovarartigo', 'before' => 'auth', 'uses' => 'revisor@reprovarartigo'));
/* Fim Rotas do Perfil Revisor */

/* Rotas do Perfil Voluntário */
Route::get('Voluntario', array('as' => 'Voluntario', 'before' => 'auth', 'uses' => 'Voluntario@Voluntario'));
Route::get('voluntario/notificacao', array('as' => 'notificacao', 'before' => 'auth', 'uses' => 'voluntario@notificacao'));
/* Fim Rotas do Perfil Voluntário */