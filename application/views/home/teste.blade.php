@layout('template.main')

@section('otherscss')
    {{ HTML::style('css/mystyle.css') }}
    {{ HTML::style('css/main.css') }}
    {{ HTML::style('css/jquery.timeline.css') }}
@endsection

@section('menu')
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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> {{ Auth::user()->firstnome }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="minharea"><i class="icon-map-marker"></i> Minha Área</a></li>
                            @if (isset($perfil))
                                <li><a href="{{$perfil}}"> Área do {{ $perfil }}</a></li>
                            @endif
                            <li class="divider"></li>
                            <li><a href="logout">Logout</a></li>
                        </ul>
                    </li>
                    @else
                        <li><a href="logar"><i class="icon-lock"></i> Login</a></li>
                    @endif
                </ul>
@endsection

    @if (Session::has('login_errors'))
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        Username ou Senha incorretos! Tente novamente.
    </div>
    @endif

@section('content')
    <section id="home">
        <div class="hero-unit">
                <div class="row">
                    <div class="span6">
                    <h1>III Composium</h1>
                    <h3>De 12 a 15 de Abril de 2013</h3>
                    <p>{{ HTML::link('inscricao', 'Inscrever-se &raquo;', array('class' => 'btn btn-primary btn-large')); }}</p>
                    </div>
                <div class="span4">
                <div class="well" style="max-width: 340px; padding: 8px 0;">
              <ul class="nav nav-list">
                <li><a href="#"><i class="icon-camera"></i> Galeria de Fotos</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-hdd"></i> Material - Apresentações</a></li>
              </ul>
            </div>
                </div>
            </div> <!-- .hero-unit -->
        </section> <!-- #home -->

        <section id="programacao">
            <h1>Programação</h1>
            <div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">16 de Abril</a></li>
    <li><a href="#tab2" data-toggle="tab">17 de Abril</a></li>
    <li><a href="#tab3" data-toggle="tab">18 de Abril</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
                  <table class="table table-hover">
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ date('H:i', strtotime($user->data)) }}</td>
                            <td style="width: 40%">{{ $user->nome }}</td>
                            <td>{{ $user->palestrante }}<br/><small>{{ $user->infopalestrante }}</small></td>
                            <td>{{ $user->local }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    <div class="tab-pane" id="tab2">
      <table class="table table-hover">
                <tbody>
                    @foreach ($segundo as $seg)
                        <tr>
                            <td>{{ date('H:i', strtotime($seg->data)) }}</td>
                            <td style="width: 40%">{{ $seg->nome }}</td>
                            <td>{{ $seg->palestrante }}<br/><small>{{ $seg->infopalestrante }}</small></td>
                            <td>{{ $seg->local }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
        <div class="tab-pane" id="tab3">
      <table class="table table-hover">
                <tbody>
                    @foreach ($terceiro as $ter)
                        <tr>
                            <td>{{ date('H:i', strtotime($ter->data)) }}</td>
                            <td>{{ $ter->nome }}</td>
                            <td>{{ $ter->palestrante }}<br/><small>{{ $ter->infopalestrante }}</small></td>
                            <td>{{ $ter->local }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
  </div>
</div>
        </section> <!-- #programação -->
    
        <section id="organizacao">
            <h2>Organizadores do Evento</h2>
            <ul class="thumbnails">
                <li class="span6">
                    <h3>Coordenadores</h3>
                    <div class="thumbnail">
                        
                        <h4 class="media-heading">Profa. Dra. Adriana Prest Mattedi</h4>
                        <p><span class="label label-inverse">DMC-ICE/UNIFEI</span></p>
                        <h4 class="media-heading">Prof. Dr. Enzo Seraphim</h4>
                        <p><span class="label label-inverse">IESTI/UNIFEI</span></p>
                        <h4 class="media-heading">Profa. Dra. Melise M. Veiga de Paula</h4>
                        <p><span class="label label-inverse">DMC-ICE/UNIFEI</span></p>
                        <h4 class="media-heading">Prof. Msc. Rodrigo Maximiano A. de Almeida</h4>
                        <p><span class="label label-inverse">IESTI/UNIFEI</span></p>
                    </div>

                     <h3>Comissão de Divulgação</h3>
                    <div class="thumbnail">
                        <h4 class="media-heading">Prof. Msc. Bruno Y. L. Kimura</h4>
                        <p><span class="label label-inverse">DMC-ICE/UNIFEI</span></p>
                        <h4 class="media-heading">André Mack Nardy</h4>
                        <p><span class="label label-inverse">SISTEMAS DE INFORMAÇÃO</span></p>
                        <h4 class="media-heading">Rui Martins Lacerda</h4>
                        <p><span class="label label-inverse">SISTEMAS DE INFORMAÇÃO</span></p>
                    </div>
                </li>
                <li class="span6">
                    <h3>Comissão de Feira-Estágio</h3>
                    <div class="thumbnail">
                    <h4 class="media-heading">Profa. Dra. Elizabete R. Sanches da Silva</h4>
                    <span class="label label-inverse">DMC-ICE/UNIFEI</span>
                    <h4 class="media-heading">Domingos Savio Faria Paes</h4>
                    <span class="label label-inverse">SISTEMAS DE INFORMAÇÃO</span>
                    </div>

                    <h3>Comissão de Infraestrutura / Patrocínio</h3>
                    <div class="thumbnail">
                    <h4 class="media-heading">Guilherme Hilst Ribeiro</h4>
                    <p><span class="label label-inverse">CIÊNCIA DA COMPUTAÇÃO</span></p>
                    <h4 class="media-heading">Thatiane Azevedo Sugiyama</h4>
                    <p><span class="label label-inverse">CIÊNCIA DA COMPUTAÇÃO</span></p>
                    <h4 class="media-heading">Douglas William Lima</h4>
                    <p><span class="label label-inverse">SISTEMAS DE INFORMAÇÃO</span></p>
                    <h4 class="media-heading">Leandro Juvêncio Mendes</h4>
                    <p><span class="label label-inverse">SISTEMAS DE INFORMAÇÃO</span></p>
                    <h4 class="media-heading">Tiago Henrique de Paula Miranda</h4>
                    <p><span class="label label-inverse">SISTEMAS DE INFORMAÇÃO</span></p>
                    </div>

                                        <h3>Comissão de Programação</h3>
                    <div class="thumbnail">
                    <h4 class="media-heading">Profa. Msc. Vanessa C. Oliveira de Souza</h4>
                    <p><span class="label label-inverse">DMC-ICE/UNIFEI</span></p>
                    </div>
                </li>
            </ul>
        </section> <!-- #organizacao -->
        
        <section id="local">
                <h2>Local do Evento</h2>
                <p>Avenida BPS, Pinherinho - Itajubá, Minas Gerais</p>
                <div id="googleMap"></div>
        </section> <!-- #local -->

        <section id="realizacao">
                <h2>Realização</h2>
                <ul class="thumbnails">
                    <li><div class="sprite-ccoblack" rel="sprite-cco"></div></li>
                    <li><div class="sprite-ecoblack" rel="sprite-eco"></div></li>
                    <li><div class="sprite-sin" rel="sprite-sin"></div></li>
                </ul>
                <ul class="thumbnails">
                    <li><div class="sprite-efeiblack" rel="sprite-efei"></div></li>
                    <li><div class="sprite-iceblack" rel="sprite-ice"></div></li>
                    <li><div class="sprite-iestiblack" rel="sprite-iesti"></div></li>
                    <li><div class="sprite-pettecblack" rel="sprite-pettec"></div></li>
                </ul>
        </section> <!-- #relizacao -->

        <section id="patrocinadores">
                <h2>Patrocionadores</h2>
                <ul class="thumbnails">
                    <li><div class="sprite-fapepeblack" rel="sprite-fapepe"></div></li>
                    <li><div class="sprite-uppertoolsblack" rel="sprite-uppertools"></div></li>
                    <li><div class="sprite-fupaiblack" rel="sprite-fupai"></div></li>
                </ul>
                <ul class="thumbnails">
                    <li><div class="sprite-barracavermelhablack" rel="sprite-barracavermelha"></div></li>
                    <li><div class="sprite-dedoprosablack" rel="sprite-dedoprosa"></div></li>
                    <li><div class="sprite-sebraeblack" rel="sprite-sebrae"></div></li>
                </ul>
        </section> <!-- #patrocionadores -->
            
        <section id="historico">
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
        </section>  <!-- #historico -->
@endsection

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
                <strong>Twitter</strong> <a href="#">Twitter</a><br />
                <strong>Facebook</strong> <a href="#">Facebook</a>
        </div> <!-- .span2 -->
        <div class="span3 offset1">
            <h5>ABOUT</h5>
            {{ HTML::image('img/logo.png', '', array('class' => 'pull-left')); }}
        </div> <!-- .span6 -->
    </div>
@endsection


@section('othersjs')
    {{ HTML::script('http://maps.google.com/maps/api/js?sensor=false'); }}
    {{ HTML::script('http://twitter.github.com/bootstrap/assets/js/bootstrap-tab.js'); }}
    {{ HTML::script('http://twitter.github.com/bootstrap/assets/js/bootstrap-alert.js'); }}
    {{ HTML::script('js/jquery.timeline.js'); }}
    {{ HTML::script('js/script.js'); }}
@endsection