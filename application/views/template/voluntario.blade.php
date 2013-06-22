<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="img/logosite.png" type="image/x-icon" />
        <title>III Composium @yield('title')</title>
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/perfil.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}
        @yield('otherscss')
    </head>
<body>
    <div class="navbar container-fluid navbar-inner">
        <ul class="nav">
                <li><h4>III Composium</h4></li>
        </ul>
        <ul class="nav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-bell-alt icon-only"></i> 
                    <span class="badge badge-info">8</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/"> Página Inicial</a></li>
                    <li class="divider"></li>
                    <li><a href="/"> Página Inicial</a></li>
                    <li class="divider"></li>
                    <li><a href="/"> Página Inicial</a></li>
                    <li class="divider"></li>
                    <li><a href="/"> Página Inicial</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> {{ Auth::user()->firstnome }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="minharea"><i class="icon-map-marker"></i> Minha Área</a></li>
                    <li class="divider"></li>
                    <li><a href="logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div> <!-- .navbar navbar-fixed-top -->

    <div id="sidebar-nav">
        <ul id="dashboard-menu" class="nav nav-list">
            <li id="1A"><a href=""><i class="icon-home"></i> <span>Home</span></a></li>
        </ul>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div id="main-stats">
                    <div class="row-fluid stats-row">
                        @yield('conteudo-topo')
                    </div>
                </div>
                @yield('conteudo')
            </div>
        </div>
    </div> <!-- .container -->


    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js'); }}
    @yield('othersjs')
    </body>
</html>