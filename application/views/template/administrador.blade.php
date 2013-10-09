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
        $notificacao = Notificacao::count_notificacao_novas('administrador');
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
                        @if ($a->perfil != 'Administrador')
                            <li>{{ HTML::link_to_action($a->perfil.'@'.$a->perfil, 'Área do ' . $a->perfil) }}</li>
                            <li class="divider"></li>
                        @endif
                    @endforeach
                    <li>{{ HTML::decode(HTML::link_to_action('Minharea@Minharea', '<i class="icon-map-marker"></i> <span>Minha Área</span>')) }}</li>
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
            <li id="1A">{{ HTML::decode(HTML::link_to_action('Administrador@Administrador', '<i class="icon-home"></i> <span>Home</span>')) }}</li>
            <li id="1B">{{ HTML::decode(HTML::link_to_action('administrador@perfis', '<i class="icon-sitemap"></i> <span>Perfis</span>')) }}</li>
            <li id="1C">{{ HTML::decode(HTML::link_to_action('administrador@usuarios', '<i class="icon-group"></i> <span>Usuários</span>')) }}</li>
            <li id="1D">{{ HTML::decode(HTML::link_to_action('administrador@galeria', '<i class="icon-camera"></i> <span>Galeria Fotos</span>')) }}</li>
            <li id="1E">{{ HTML::decode(HTML::link_to_action('administrador@programacao', '<i class="icon-calendar"></i> <span>Programação</span>')) }}</li>
            <li id="1F">{{ HTML::decode(HTML::link_to_action('administrador@manutencao', '<i class="icon-cogs"></i> <span>Manutenção</span>')) }}</li>
            <li id="1G"><a href="#"><i class="icon-upload-alt"></i> <span>Material</span></a></li>
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
                    url: BASE+'/administrador/notificacao',
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