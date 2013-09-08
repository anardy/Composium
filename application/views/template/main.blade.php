<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="img/logosite.png" type="image/x-icon" />
        <title>III Composium @yield('title')</title>
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/main.css') }}
        @yield('otherscss')
    </head>
<body data-spy="scroll" data-target="#menu">
    <div class="navbar navbar-fixed-top container-fluid navbar-inner">        
            @yield('menu')
    </div> <!-- .navbar navbar-fixed-top -->

    <div class="container">
        <div class="row">
        
        @yield('content')

        </div>
    </div> <!-- .container -->

    <footer>
        <div class="container">
        <div class="span12">
        <div class="span4">
            <h5>ENDEREÇO</h5>
                <strong>Universidade Federal de Itajubá</strong><br />
                Avenida BPS, Pinherinho<br />
                Itajubá, Minas Gerais<br />
                <abbr title="Phone">T:</abbr> (35) 3629-1434<br />
                <strong>E-mail</strong> <a href="mailto:composium@unifei.edu.br">composium@unifei.edu.br</a>
        </div> <!-- .span4 -->
        <div class="span2">
            <h5>REDES SOCIAIS</h5>
                <a href="https://www.facebook.com/composium" target="_blank">{{ HTML::image('img/facebook.png', ''); }}</a>
                &nbsp;<a href="https://twitter.com/ComposiumUnifei" target="_blank">{{ HTML::image('img/twitter.png', ''); }}</a>
        </div> <!-- .span2 -->
        <div class="span3 offset1">
            <h5>ABOUT</h5>
            {{ HTML::image('img/logo.png', '', array('class' => 'pull-left')); }}
        </div> <!-- .span6 -->
    </div>

    </footer> <!-- #footer -->

    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('js/bootstrap.min.js'); }}
    @yield('othersjs')
    </body>
</html>