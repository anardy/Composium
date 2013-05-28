<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="Content-Type: text/html; charset=UTF-8">
        <title>III Composium</title>
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/mystyle.css') }}
        {{ HTML::style('css/jquery.timeline.css') }}
    </head>
<body data-spy="scroll" data-target="#menu">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <div id="menu">
                <ul class="nav">
                    <li class="active"><a href="#home">Home</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="#programacao">Programação</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="#organizacao">Organização</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="#local">Local</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="#contato">Contato</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="#realizacao">Realização</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="#patrocinadores">Patrocionadores</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="#historico">Histórico Eventos</a></li>
                </ul>
                </div>
                <ul class="nav pull-right">
                    @if (Auth::user())
                        <li class="dropdown">
                            <a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->username }} <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                                <li role="presentation"><a href="#" data-toggle="modal">Minha Situação</a></li>
                                <li role="presentation"><a href="#">Submissão Artigo</a></li>
                                <li role="presentation"><a href="#">Certificado</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation">{{ HTML::link('logout', 'Logout') }}</li>
                            </ul>
                        </li>
                    @else
                        <li><a href="#login" data-toggle="modal">Login</a></li>
                    @endif
                </ul>
            </div> <!-- container-fluid -->
        </div> <!-- .navbar-inner -->
    </div> <!-- .navbar navbar-fixed-top -->

    @if (Session::has('login_errors'))
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        Username ou Senha incorretos! Tente novamente.
    </div>
    @endif

    <div class="container">
        <div id="home">
            <div class="hero-unit">
                <h1>III Composium</h1>
                <h3>De 12 a 15 de Abril de 2013</h3>
                @if (Auth::guest())
                <p>{{ HTML::link('inscricao', 'Inscrever-se &raquo;', array('class' => 'btn btn-primary btn-large')); }}</p>
                @endif
            </div> <!-- .hero-unit -->
        </div> <!-- #home -->
        
        <div id="programacao">
            <div class="row">
                <hr class="featurette-divider"> <!-- linha horizontal -->
                <h2>Programação</h2>
                <div class="span10">
                    <p>
                        {{ HTML::link('#', '1º Dia', array('class' => 'btn btn-primary btn-large', 'id' => 'primeirodia')); }}
                        {{ HTML::link('#', '2º Dia', array('class' => 'btn btn-primary btn-large', 'id' => 'segundodia')); }}
                        {{ HTML::link('#', '3º Dia', array('class' => 'btn btn-primary btn-large', 'id' => 'terceirodia')); }}
                    </p>
                </div>
                <div class="span2">
                    {{ HTML::link('#', 'PDF', array('class' => 'btn btn-primary btn-large', 'id' => 'primeirodia')); }}
                </div>
                <div id="contentprogram" class="span12"></div>
                <div id="carregando" class="span12">{{ HTML::image('img/carregando.gif', ''); }}</div>
            </div> <!-- .row -->
        </div> <!-- #programação -->
    
        <div id="organizacao">
            <div class="row">
                <hr class="featurette-divider"> <!-- linha horizontal -->
                <h2>Organizadores do Evento</h2>
                <h3>Coordenadores</h3>
                <div class="span6">
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Profa. Dra. Adriana Prest Mattedi</h4>
                            <p>Departamento: DMC-ICE/UNIFEI</p>
                        </div>
                    </div>
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Prof. Dr. Enzo Seraphim</h4>
                            <p>Departamento: IESTI/UNIFEI</p>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Profa. Dra. Melise M. Veiga de Paula</h4>
                            <p>Departamento: DMC-ICE/UNIFEI</p>
                        </div>
                    </div>
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Prof. Msc. Rodrigo Maximiano A. de Almeida</h4>
                            <p>Departamento: IESTI/UNIFEI</p>
                        </div>
                    </div>
                </div>
                <h3>Comissão de Programação</h3>
                <div class="span12">
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Profa. Msc. Vanessa C. Oliveira de Souza</h4>
                            <p>Departamento: DMC-ICE/UNIFEI</p>
                        </div>
                    </div>
                </div>
                <h3>Comissão de Infraestrutura / Patrocínio</h3>
                <div class="span6">
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Guilherme Hilst Ribeiro</h4>
                            <p>Curso: Ciência da Computação</p>
                        </div>
                    </div>
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Thatiane Azevedo Sugiyama</h4>
                            <p>Curso: Ciência da Computação</p>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Douglas William Lima</h4>
                            <p>Curso: Sistemas de Informação</p>
                        </div>
                    </div>
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Leandro Juvêncio Mendes</h4>
                            <p>Curso: Sistemas de Informação</p>
                        </div>
                    </div>
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Tiago Henrique de Paula Miranda</h4>
                            <p>Curso: Sistemas de Informação</p>
                        </div>
                    </div>
                </div>
                <h3>Comissão de Divulgação</h3>
                <div class="span6">
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Prof. Msc. Bruno Y. L. Kimura</h4>
                            <p>Departamento: DMC-ICE/UNIFEI</p>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">André Mack Nardy</h4>
                            <p>Curso: Sistemas de Informação</p>
                        </div>
                    </div>
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Rui Martins Lacerda</h4>
                            <p>Curso: Sistemas de Informação</p>
                        </div>
                    </div>
                </div>
                <h3>Comissão de Feira-Estágio</h3>
                <div class="span6">
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Profa. Dra. Elizabete R. Sanches da Silva</h4>
                            <p>Departamento: DMC-ICE/UNIFEI</p>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="media">
                        {{ HTML::image('img/richard.jpg', '', array('class' => 'pull-left')); }}
                        <div class="media-body">
                            <h4 class="media-heading">Domingos Savio Faria Paes</h4>
                            <p>Curso: Sistemas de Informação</p>
                        </div>
                    </div>
                </div>
            </div> <!-- .row -->
        </div> <!-- #organizacao -->
        
        <div id="local">
            <div class="row">
                <hr class="featurette-divider"> <!-- linha horizontal -->
                <h2>Local do Evento</h2>
                <div id="googleMap" style="width:500px;height:380px;"></div>
            </div><!-- .row -->
        </div> <!-- #local -->
    
        <div id="contato">
            <div class="row">
                <hr class="featurette-divider"> <!-- linha horizontal -->
                <h2>Contato</h2>
                <address>
                    <strong>Universidade Federal de Itajubá</strong><br />
                    Avenida BPS, Pinherinho<br />
                    Itajubá, Minas Gerais<br />
                    <abbr title="Phone">T:</abbr> (35) 3629-1434<br />
                    <strong>E-mail</strong> <a href="mailto:composium@unifei.edu.br">composium@unifei.edu.br</a><br />
                    <strong>Twitter</strong> <a href="#">Twitter</a><br />
                    <strong>Facebook</strong> <a href="#">Facebook</a>
                </address> <!-- address -->
            </div> <!-- .row -->
        </div> <!-- #contato -->

        <div id="realizacao">
            <div class="row">
                <hr class="featurette-divider"> <!-- linha horizontal -->
                <h2>Realização</h2>
                <div class="span3">
                    <p style="background:url('../../public/img/result.png') -0px -203px;width: 160px; height: 122px;"></p> <!-- img efei -->
                    <p style="background:url('../../public/img/result.png') -0px -335px;width: 140px; height: 93px;"></p> <!-- img ice -->
                </div><!-- .span3 -->
                <div class="span3">
                    <p style="background:url('../../public/img/result.png') -0px -438px;width: 160px; height: 78px;"></p> <!-- img iesti -->
                    <p style="background:url('../../public/img/result.png') -0px -526px;width: 160px; height: 117px;"></p> <!-- img pettec -->
                </div><!-- .span3 -->
                <div class="span3">
                    <p style="background:url('../../public/img/result.png') -0px -0px;width: 110px; height: 101px;"></p> <!-- img cco -->
                    <p style="background:url('../../public/img/result.png') -0px -111px;width: 130px; height: 82px;"></p> <!-- img eco -->
                </div><!-- .span3 -->
                <div class="span3">
                    <p style="background:url('../../public/img/result.png') -0px -653px;width: 120px; height: 121px;"></p> <!-- img si -->
                </div><!-- .span3 -->
            </div> <!-- .row -->
        </div> <!-- #relizacao -->
        
        <div id="patrocinadores">
            <div class="row">
                <hr class="featurette-divider"> <!-- linha horizontal -->
                <h2>Patrocionadores</h2>
                <div class="span4">
                    <p style="display:inline-block;background:url('../../public/img/patrocionadores.png') -0px -296px;width: 182px; height: 90px;"></p> <!-- img fapepe -->
                </div> <!-- .span4 -->
                <div class="span4">
                    <p style="display:inline-block;background:url('../../public/img/patrocionadores.png') -0px -474px;width: 250px; height: 59px;"></p> <!-- img upertools -->
                </div> <!-- .span4 -->
                <div class="span4">
                    <p style="display:inline-block;background:url('../../public/img/patrocionadores.png') -0px -176px;width: 64px; height: 110px;"></p> <!-- img fupai -->
                </div> <!-- .span4 -->
                <div class="span4">
                    <p style="display:inline-block;background:url('../../public/img/patrocionadores.png') -0px -396px;width: 90px; height: 68px;"></p> <!-- img sebrae-mg -->
                </div> <!-- .span4 -->
                <div class="span4">
                    <p style="display:inline-block;background:url('../../public/img/patrocionadores.png') -0px -81px;width: 80px; height: 85px;"></p> <!-- img dedoprosa -->
                </div> <!-- .span4 -->
                <div class="span4">
                    <p style="display:inline-block;background:url('../../public/img/patrocionadores.png') -0px -0px;width: 100px; height: 71px;"></p> <!-- img barracavermelha -->
                </div> <!-- .span4 -->
            </div> <!-- .row -->
        </div> <!-- #patrocionadores -->
            
        <div id="historico">
            <div class="row">
                <hr class="featurette-divider"> <!-- linha horizontal -->
                <h2>Histórico de Eventos</h2>
                <div id="timeline">
                    <ul>
                        <li data-date="1999">12º SBM – Congresso da Sociedade Brasileira de Microeletrônica</li>
                        <li data-date="2000">1° SETI – Seminário em Tecnologia da Informação</li>
                        <li data-date="2003">I SECOMP – Seminário em Computação</li>
                        <li data-date="2004">SAT – Semana Acadêmica de Tecnologia</li>
                        <li data-date="2005">II SECOMP – Seminário em Computação</li>
                        <li data-date="2006">IV EMECOMP Encontro Mineiro dos Estudantes de Computação</li>
                        <li data-date="2007">III SECOMP – Seminário em Computação: Tecnologias Móveis</li>
                        <li data-date="2008">I COMPOSIUM – I Simpósio em Computação da UNIFEI</li>
                        <li data-date="2009">EMSL – Encontro Mineiro de Software Livre</li>
                        <li data-date="2011">I OW – Open Week e Workshop de Software</li>
                        <li data-date="2012">II Composium – II Simpósio em Computação da UNIFEI</li>
                        <li data-date="2013">III Composium – III Simpósio em Computação da UNIFEI</li>
                    </ul>
                </div>
            </div> <!-- .row -->
        </div>  <!-- #historico -->
    
    </div> <!-- .container -->
    
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
    
    
    <div id="login" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Login Composium</h3>
        </div>
        <div class="modal-body">
            {{ Form::open('login') }}
                <p>{{ Form::text('username', '', array('placeholder' => 'Login')) }}</p>
                <p>{{ Form::password('password', array('placeholder' => 'Senha')) }}</p>
                <p>{{ Form::submit('Logar') }}</p>
                <label>&raquo; <a href="#">Esqueceu sua senha?</a></label>
            {{ Form::close() }}
        </div>
    </div>
    {{ HTML::script('js/jquery.min.js'); }}
    {{ HTML::script('http://maps.google.com/maps/api/js?sensor=false'); }}
    {{ HTML::script('http://twitter.github.com/bootstrap/assets/js/bootstrap-modal.js'); }}
    {{ HTML::script('http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js'); }}
    {{ HTML::script('http://twitter.github.com/bootstrap/assets/js/bootstrap-alert.js'); }}
    {{ HTML::script('http://twitter.github.com/bootstrap/assets/js/bootstrap-scrollspy.js'); }}
    {{ HTML::script('js/jquery.timeline.js'); }}
    {{ HTML::script('js/script.js'); }}
    <script>
        var BASE = "{{ URL::base(); }}"
    </script>
    </body>
</html>