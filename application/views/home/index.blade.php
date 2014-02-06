@layout('template.main')

@section('otherscss')
    {{ HTML::style('css/mystyle.css') }}
    {{ HTML::style('css/main.css') }}
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
                            @if (isset($perfil))
                                @foreach ($perfil as $a)
                                    <li>{{ HTML::link_to_action($a->perfil.'@'.$a->perfil, 'Área do ' . $a->perfil) }}</li>
                                    <li class="divider"></li>
                                @endforeach
                            @endif
                            <li>{{ HTML::decode(HTML::link_to_action('Minharea@Minharea', '<i class="icon-map-marker"></i> <span>Minha Área</span>')) }}</li>
                            <li class="divider"></li>
                            <li><a href="logout">Logout</a></li>
                        </ul>
                    </li>
                    @else
                        <li><a href="logar"><i class="icon-lock"></i> Login</a></li>
                    @endif
                </ul>
@endsection

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
                        <h4 class="media-heading">Nome 1</h4>
                        <p><span class="label label-inverse">Departamento</span></p>
                        <h4 class="media-heading">Nome 2</h4>
                        <p><span class="label label-inverse">Departamento</span></p>
                        <h4 class="media-heading">Nome 3</h4>
                        <p><span class="label label-inverse">Departamento</span></p>
                        <h4 class="media-heading">Nome 4</h4>
                        <p><span class="label label-inverse">Departamento</span></p>
                    </div>

                     <h3>Comissão de Divulgação</h3>
                    <div class="thumbnail">
                        <h4 class="media-heading">Nome 5</h4>
                        <p><span class="label label-inverse">Departamento</span></p>
                        <h4 class="media-heading">Nome 6</h4>
                        <p><span class="label label-inverse">Departamento</span></p>
                        <h4 class="media-heading">Nome 7</h4>
                        <p><span class="label label-inverse">Departamento</span></p>
                    </div>
                </li>
                <li class="span6">
                    <h3>Comissão de Feira-Estágio</h3>
                    <div class="thumbnail">
                    <h4 class="media-heading">Nome 8</h4>
                    <span class="label label-inverse">Departamento</span>
                    <h4 class="media-heading">Nome 9</h4>
                    <span class="label label-inverse">Departamento</span>
                    </div>

                    <h3>Comissão de Infraestrutura / Patrocínio</h3>
                    <div class="thumbnail">
                    <h4 class="media-heading">Nome 10</h4>
                    <p><span class="label label-inverse">Departamento</span></p>
                    <h4 class="media-heading">Nome 11</h4>
                    <p><span class="label label-inverse">Departamento</span></p>
                    <h4 class="media-heading">Nome 12</h4>
                    <p><span class="label label-inverse">Departamento</span></p>
                    <h4 class="media-heading">Nome 13</h4>
                    <p><span class="label label-inverse">Departamento</span></p>
                    <h4 class="media-heading">Nome 14</h4>
                    <p><span class="label label-inverse">Departamento</span></p>
                    </div>

                                        <h3>Comissão de Programação</h3>
                    <div class="thumbnail">
                    <h4 class="media-heading">Nome 15</h4>
                    <p><span class="label label-inverse">Departamento</span></p>
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
                    <li>{{ HTML::image('img/realizacao.png', ''); }}</li>
                    <li>{{ HTML::image('img/realizacao.png', ''); }}</li>
                    <li>{{ HTML::image('img/realizacao.png', ''); }}</li>
					<li>{{ HTML::image('img/realizacao.png', ''); }}</li>
                </ul>
                <ul class="thumbnails">
                    <li>{{ HTML::image('img/realizacao.png', ''); }}</li>
                    <li>{{ HTML::image('img/realizacao.png', ''); }}</li>
                    <li>{{ HTML::image('img/realizacao.png', ''); }}</li>
                    <li>{{ HTML::image('img/realizacao.png', ''); }}</li>
                </ul>
        </section> <!-- #relizacao -->

        <section id="patrocinadores">
            <div class="span12">
                <div class="row">
                <h2>Patrocionadores</h2>
                <div class="span6">
    				<h2>Golden</h2>
                    <ul class="thumbnails">
                        <li>{{ HTML::image('img/golden.png', ''); }}</li>
                        <li>{{ HTML::image('img/golden.png', ''); }}</li>
                    </ul>
                </div>
                <div class="span6">
    				<h3>Silver</h3>
                    <ul class="thumbnails">
                        <li>{{ HTML::image('img/silver.png', ''); }}</li>
                        <li>{{ HTML::image('img/silver.png', ''); }}</li>
                    </ul>
    				<h4>Bronze</h4>
                    <ul class="thumbnails">
                        <li>{{ HTML::image('img/bronze.png', ''); }}</li>
                        <li>{{ HTML::image('img/bronze.png', ''); }}</li>
                    </ul>
                </div>
                </div>
            </div>
        </section> <!-- #patrocionadores -->
            
        <section id="historico">
                <h2>Histórico de Eventos</h2>
				<p><span class="label label-inverse">1999</span> 12º SBM – Congresso da Sociedade Brasileira de Microeletrônica</p>
                <p><span class="label label-inverse">2000</span> 1° SETI – Seminário em Tecnologia da Informação</p>
                <p><span class="label label-inverse">2003</span> I SECOMP – Seminário em Computação</p>
                <p><span class="label label-inverse">2004</span> SAT – Semana Acadêmica de Tecnologia</p>
                <p><span class="label label-inverse">2005</span> II SECOMP – Seminário em Computação</p>
                <p><span class="label label-inverse">2006</span> IV EMECOMP Encontro Mineiro dos Estudantes de Computação</p>
                <p><span class="label label-inverse">2007</span> III SECOMP – Seminário em Computação: Tecnologias Móveis</p>
                <p><span class="label label-inverse">2008</span> I COMPOSIUM – I Simpósio em Computação da UNIFEI</p>
                <p><span class="label label-inverse">2009</span> EMSL – Encontro Mineiro de Software Livre</p>
                <p><span class="label label-inverse">2011</span> I OW – Open Week e Workshop de Software</p>
                <p><span class="label label-inverse">2012</span> II Composium – II Simpósio em Computação da UNIFEI</p>
                <p><span class="label label-inverse">2013</span> III Composium – III Simpósio em Computação da UNIFEI</p>
        </section>  <!-- #historico -->
@endsection

@section('othersjs')
    {{ HTML::script('http://maps.google.com/maps/api/js?sensor=false'); }}
    {{ HTML::script('js/script.js'); }}
@endsection