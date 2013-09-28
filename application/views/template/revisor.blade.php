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
    <?php
        $notificacao = Notificacao::count_notificacao_novas('revisor');
    ?>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <div class="nav-collapse collapse">
        <ul class="nav">
                <li><h4>III Composium</h4></li>
        </ul>
        <ul class="nav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notificar">
                    <i class="icon-bell-alt icon-only"></i>
                    @if ($notificacao > 0)
                        <span class="badge badge-info">{{$notificacao}}</span>
                    @endif
                </a>
                <ul class="dropdown-menu">
                    <div id="notificacao"></div>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> {{ Auth::user()->firstnome }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    @foreach (Perfil::eh_admin(Auth::user()->cpf) as $a)
                        @if ($a->perfil != 'Revisor')
                            <li><a href="{{$a->perfil}}"> Área do {{ $a->perfil }}</a></li>
                            <li class="divider"></li>
                        @endif
                    @endforeach
                    <li>{{ HTML::decode(HTML::link('minharea', '<i class="icon-map-marker"></i> <span>Minha Área</span>')) }}</li>
                    <li class="divider"></li>
                    <li><a href="logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
    </div>
    </div> <!-- .navbar navbar-fixed-top -->

    <div id="sidebar-nav">
        <ul id="dashboard-menu" class="nav nav-list">
            <li id="1A">{{ HTML::decode(HTML::link('Revisor', '<i class="icon-home"></i> <span>Home</span>')) }}</li>
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
                <div id="teste">
                    @yield('conteudo')
                </div>
            </div>
        </div>
    </div> <!-- .container -->


    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('js/bootstrap.min.js'); }}
    <script>
        var BASE = "<?php echo URL::base(); ?>";
        $(document).ready(function(){
            $('#notificar').click(function(e) {
                e.preventDefault();
                if ($('#notificacao').is(':empty')) {
                    $.ajax({
                        type: 'GET',
                        url: BASE+'/notificacaoRevisor',
                        beforeSend: function() {
                            $('#notificacao').html('Carregando...');
                        },
                        success: function(data) {
                            $('#notificacao').html(data);
                        }
                    });
                }
            });
        });
    </script>
    @yield('othersjs')
    </body>
</html>