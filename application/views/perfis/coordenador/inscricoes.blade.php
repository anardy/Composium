@layout('template.coordenador')

@section('title')
- Coordenador
@endsection

@section('otherscss')
{{ HTML::style('css/morris.css') }}
@endsection

@section('conteudo')
<div class="span12">
	<h3>Inscrições</h3>
	<div class="row-fluid">

		<div class="light-gray inner">
	<div class="row-fluid">
<div class="span2 center">
    <div class="stat-box medium-blue">
      <i class="icon-group icon-large"></i>
      <span class="count">134</span>
      <span class="stat-text">Usuá. Pagos</span>
    </div>
</div>

<div class="span2 center">
        <div class="stat-box medium-blue">
      <i class="icon-group icon-large"></i>
      <span class="count">134</span>
      <span class="stat-text">Usuá. A Pagar</span>
    </div>
</div>
<div class="span2 center">
        <div class="stat-box medium-blue">
      <i class="icon-group icon-large"></i>
      <span class="count">134</span>
      <span class="stat-text">Vencidos</span>
    </div>
</div>
</div>
</div>

<div class="span11">
<div class="row-fluid">
<div class="box span5">
    <div class="box-header">
        <h2><i class="icon-signal"></i><span class="break"></span>Usuários por Curso</h2>
    </div>
    <div class="sparkLineStats">
        <div class="box-content">
            <div id="porcurso"></div>
        </div>
    </div>

    <div class="box-header">
        <h2><i class="icon-signal"></i><span class="break"></span>Usuários por Instituição</h2>
    </div>
    <div class="sparkLineStats">
        <div class="box-content">
            <div id="porinstuicao"></div>
        </div>
    </div>
</div>

<div class="box span7">
    <div class="box-header">
        <h2><i class="icon-signal"></i><span class="break"></span>Mais Procurados</h2>
    </div>
    <div class="sparkLineStats">
        <div class="box-content">
          <table class="table table-hover">
            <thead>
              <th>#</th>
              <th>Nome</th>
              <th>Participantes</th>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach ($maisprocurados as $mp)
              <tr>
                <td>{{$i++}}</td>
                <td>
                  <span style='display: block;'>{{ $mp->abreviacao }}</span>
                  <span class="subtext">{{$mp->nome}}</span>
                </td>
                <td>{{$mp->total}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>

<div class="box span3">
    
</div>
</div>
</div>
</div>
</div>

@endsection

@section('othersjs')
{{ HTML::script('js/morris.min.js'); }}
{{ HTML::script('js/raphael.2.1.0.min.js'); }}
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1C").toggleClass('active');

});
Morris.Donut({
  element: 'porcurso',
  data: {{$porcurso}},
  colors: [
    '#0BA462',
    '#39B580',
    '#67C69D',
    '#95D7BB'
  ]
});

Morris.Donut({
  element: 'porinstuicao',
  data: {{$porinstuicao}},
  colors: [
    '#0BA462',
    '#39B580',
    '#67C69D',
    '#95D7BB'
  ]
});
</script>
@endsection