<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="Content-Type: text/html; charset=UTF-8">
        <title>III Composium @yield('title')</title>
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/mystyle.css') }}
        @yield('otherscss')
    </head>
<body>
        <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <div id="menu">
                    <ul class="nav">
                        <li><a href="/">Home</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="#">Exemplo</a></li>
                    </ul>
                </div>
            </div> <!-- container-fluid -->
        </div> <!-- .navbar-inner -->
    </div> <!-- .navbar navbar-fixed-top -->

    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>

    <div id="footer">
        <div class="span4">
            <p style="background:url('../../public/img/result.png') -0px -203px;width: 160px; height: 122px;"></p>
        </div> <!-- .span4 -->
        <div class="span9">
            <p>III Composium - Simpósio de Computação da Universidade Federal de Itajubá.</p>
            <p>Av. BPS, 1303, Pinheirinho, Itajubá/MG</p>
            <p>Copyright © 2013.</p>
        </div> <!-- .span9 -->
        <div class="span2">
            <img src="../../public/img/logo.png" />
        </div> <!-- .span2 -->
    </div> <!-- #footer -->

    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('http://twitter.github.com/bootstrap/assets/js/bootstrap.min.js'); }}
    @yield('othersjs')
</body>
</html>