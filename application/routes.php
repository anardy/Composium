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

Route::get('/', function()
{
	return View::make('home.teste');
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
    return View::make('home.teste');
});

Route::post('login', function() {
	$userdata = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

	if (Auth::attempt($userdata)) {
		return View::make('home.teste');
	} else {
		return Redirect::to('/')->with('login_errors', true);
	}
});

Route::get('logout', function() {
	Auth::logout();
	return View::make('home.teste');
});

Route::get('inscricao', function() {
    return View::make('inscricao.home');
});

Route::get('inicioinscricao', function() {
    return View::make('inscricao.dadosPessoais');
});

Route::post('cadDadosPessoais', function() {
	$new_date = array(
		'nome' => Input::get('nome'),
		'username' => Input::get('username'),
		'senha' => Input::get('senha'),
		'cpf' => Input::get('cpf'),
		'telefone' => Input::get('telefone'),
		'matricula' => Input::get('matricula'),
		'email' => Input::get('email'),
		'instituicao' => Input::get('instituicao'),
		'curso' => Input::get('curso'),
		'ano' => Input::get('ano'),
		'periodo' => Input::get('periodo')
		);

	$regras = array(
		'nome' => 'required',
		'username' => 'required',
		'senha' => 'required',
		'cpf' => 'required',
		'email' => 'required',
		'ano' => 'required',
		'periodo' => 'required'
		);

	$v = Validator::make($new_date, $regras);

	/*if ($v->fails()) {
		return Redirect::to('inicioinscricao')->with_errors($v)->with_input();
	}

	$cadastro = new Cadastro($new_date);
	$cadastro->save();*/

	$users = Programacao::teste('2012-04-16');
    return View::make('inscricao.primeirodiaInscricao')->with('users',$users);;
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
		Input::get('opQua9'),
		Input::get('opQua10'),
		Input::get('opQua14')
		);

	$contaminicuros = 0;
	
	$precoBASICO = 5;
	$precoCOMP = 10;
	$precoUNIFEI = 20;
	$precoOUTRA = 30;
	$precoBASICOUTRA = 30;

	for ($i = 0, $len = sizeof($all_palestras); $i < $len; $i++) {
		if (substr($all_palestras[$i], 0, 1) == "M") {
			$contaminicuros++;
			array_push($minicursos, $all_palestras[$i]);
		}
	}

	$users = Cadastro::pesquisa_usuario_calculo('111.111.111-11');

	foreach ($users as $user) {
		$instituicao = $user->instituicao;
		$curso = $user->curso;
	}

	if (($instituicao == 'UNIFEI') || ($instituicao == 'ITABIRA')) {
		if (($curso == 'CCO') || ($curso == 'SIN') || ($curso == 'ECO'))
			$total = (((int) $contaminicuros * (int) $precoCOMP)+(int)$precoBASICO);
		else {
			$total = (((int) $contaminicuros * (int) $precoUNIFEI)+(int)$precoBASICO);
		}
	} else if ($instituicao == 'OUTRA') {
		$total = (((int) $contaminicuros * (int) $precoOUTRA)+(int) $precoBASICOUTRA);
	}

	return View::make('inscricao.confirmacaoInscricao')->with('total', $total)->with('minicursos', $minicursos);
});

Route::post('cadConcluir', function() {
	
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
		Input::get('opQua9'),
		Input::get('opQua10'),
		Input::get('opQua14')
		);


	for ($i = 0, $len = sizeof($all_palestras); $i <= $len; $i++) {
    	if (!empty($all_palestras[$i])) {
			DB::table('presencas')->insert(array('cpf' => '111.111.111-11', 'abreviacao' => $all_palestras[$i], 'presenca' => 0));
		}
    }

    //DB::table('inscricoes')->insert(array('cpf' => '111.111.111-11', 'status' => '0, 'valor' => $total));
	//return View::make('home.teste');
});


Route::get('primeirodiaProgramacao', function() {
	$users = Programacao::teste('2012-04-16');
    return View::make('programacao.home')->with('users',$users)->with('dia','Segunda-Feira');
});

Route::get('segundodiaProgramacao', function() {
	$users = Programacao::teste('2012-04-17');
    return View::make('programacao.home')->with('users',$users)->with('dia','Terça-Feira');
});

Route::get('terceirodiaProgramacao', function() {
	$users = Programacao::teste('2012-04-18');
    return View::make('programacao.home')->with('users',$users)->with('dia','Quarta-Feira');
});