<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="img/logosite.png" type="image/x-icon" />
        <title>III Composium @yield('title')</title>
        {{ HTML::style('css/bootstrap.min.css') }}
        @yield('otherscss')
    </head>
<body>
    
    <div class="container">
		<div class="row">
    		@yield('content')
    	</div>
    </div>

    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('js/jquery.min.js'); }}
    @yield('othersjs')
</body>
</html>