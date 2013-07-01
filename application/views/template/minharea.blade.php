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
        $notificacao = Notificacao::count_notificacao_novas_user(Auth::user()->cpf);
    ?>
    <div class="navbar container-fluid navbar-inner">
        <ul class="nav">
                <li><h4>III Composium</h4></li>
        </ul>
        <ul class="nav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notificar">
                    <i class="icon-envelope icon-only"></i> 
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
                        <li><a href="{{$a->perfil}}"> Área do {{ $a->perfil }}</a></li>
                        <li class="divider"></li>
                    @endforeach
                    <li><a href="logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div> <!-- .navbar navbar-fixed-top -->

    <div id="sidebar-nav">
        <ul id="dashboard-menu" class="nav nav-list">
            <li id="1A"><a href="minharea"><i class="icon-home"></i> <span>Home</span></a></li>
            <li id="1B"><a href="artigo"><i class="icon-paper-clip"></i> <span>Submissão Artigo</span></a></li>
            <li id="1C"><a href="presenca"><i class="icon-check"></i> <span>Controle Presença</span></a></li>
            <li id="1D"><a href="certificado"><i class="icon-bookmark"></i> <span>Certificados</span></a></li>
            <li id="1E"><a href="voluntario"><i class="icon-male"></i> <span>Voluntário</span></a></li>
            <li id="1F"><a href="#"><i class="icon-upload-alt"></i> <span>Material</span></a></li>
            <li id="1G"><a href="meudados"><i class="icon-wrench"></i> <span>Meus Dados</span></a></li>
        </ul>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row-fluid">
                @yield('conteudo')
            </div>
        </div>
    </div> <!-- .container -->


    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js'); }}
    <script>
        var BASE = "<?php echo URL::base(); ?>";
        $(document).ready(function(){
            $('#notificar').click(function(e) {
                e.preventDefault();
                if ($('#notificacao').is(':empty')) {
                $.ajax({
                    type: 'GET',
                    url: BASE+'/notificacao',
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