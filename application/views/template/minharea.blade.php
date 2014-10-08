<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="img/logosite.png" type="image/x-icon" />
        <title>III Composium @yield('title')</title>
        {{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/bootstrap-responsive.min.css') }}
        {{ HTML::style('css/perfil.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}
        @yield('otherscss')
    </head>
<body>
    <?php
        $notificacao = Notificacao::count_notificacao_novas_user(Auth::user()->cpf);
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
                        <span class="badge badge-info" id="nro_notificacoes">{{$notificacao}}</span>
                    @endif                  
                </a>
                <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-closer">
                    <div id="notificacao"></div>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> {{ Auth::user()->firstnome }} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    @foreach (Perfil::eh_admin(Auth::user()->cpf) as $a)
                        <li>{{ HTML::link_to_action($a->perfil.'@'.$a->perfil, 'Área do ' . $a->perfil) }}</li>
                        <li class="divider"></li>
                    @endforeach
                    <li>{{ HTML::link_to_action('home@logout', 'Logout') }}</li>
                </ul>
            </li>
        </ul>
    </div> <!-- .navbar navbar-fixed-top -->
</div>
</div>
</div>

    <div id="sidebar-nav">
        <ul id="dashboard-menu" class="nav nav-list">
            <li id="1A">{{ HTML::decode(HTML::link_to_action('Minharea@Minharea', '<i class="icon-home"></i> <span>Home</span>')) }}</li>
            {{Inscricao::user_pagou(Auth::user()->cpf)[0]->status}}
            @if ((Inscricao::user_pagou(Auth::user()->cpf)) && (Inscricao::user_pagou(Auth::user()->cpf)[0]->status))
                <li id="1B">{{ HTML::decode(HTML::link_to_action('minharea@artigo', '<i class="icon-paper-clip"></i> <span>Submissão Artigo</span>')) }}</li>
                <li id="1C">{{ HTML::decode(HTML::link_to_action('minharea@presenca', '<i class="icon-check"></i> <span>Controle Presença</span>')) }}</li>
                <li id="1D">{{ HTML::decode(HTML::link_to_action('minharea@certificado', '<i class="icon-bookmark"></i> <span>Certificados</span>')) }}</li>
                <li id="1E">{{ HTML::decode(HTML::link_to_action('minharea@voluntario', '<i class="icon-male"></i> <span>Voluntário</span>')) }}</li>
                <li id="1G"><a href="#"><i class="icon-upload-alt"></i> <span>Material</span></a></li>
            @elseif (Inscricao::user_pagou(Auth::user()->cpf))
                <li id="1I">{{ HTML::decode(HTML::link_to_action('minharea@boleto', '<i class="icon-barcode"></i> <span>Boleto</span>')) }}</li>
                <li id="1F">{{ HTML::decode(HTML::link_to_action('minharea@reinscricao', '<i class="icon-bookmark"></i> <span>Reinscrição</span>')) }}</li>
            @endif
            <li id="1H">{{ HTML::decode(HTML::link_to_action('minharea@meusdados', '<i class="icon-wrench"></i> <span>Meus Dados</span>')) }}</li>
        </ul>
    </div>

    <div class="content">
        <div class="container-narrow">
            <div class="row-fluid">
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
                    url: BASE+'/minharea/notificacao',
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