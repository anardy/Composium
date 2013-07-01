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
            <div class="wizard">
                <a id="1A"><span id="span1A" class="badge">1</span>1º Dia</a>
                <a id="1B"><span id="span1B" class="badge">2</span>2º Dia</a>
                <a id="1C"><span id="span1C" class="badge">3</span>3º Dia</a>
                <a id="1D"><span id="span1D" class="badge">4</span>Confirmação</a>
            </div>
    		@yield('content')
    	</div>
    </div>

    {{ HTML::script('js/jquery.min.js'); }}
    @yield('othersjs')
</body>
</html>