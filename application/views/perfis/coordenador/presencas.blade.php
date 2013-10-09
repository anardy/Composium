@layout('template.coordenador')

@section('title')
- Coordenador
@endsection

@section('otherscss')
{{ HTML::style('css/morris.css') }}
@endsection

@section('conteudo')
<div class="span12">
	<h3>Presenças</h3>
	<div class="row-fluid">
		<div class="span6 offset3">
    {{ Form::open(action('coordenador@presencas', '', array('class' => 'form-inline', 'id' => 'form'))) }}
   	{{ Form::select('palestras', array('all' => 'Selecione..') + $palestras, null, array('id' => 'palestras', 'class' => 'span8')) }}
{{ Form::close() }}
</div>


<div class="span11">
        <hr>
    <div id="result"></div>
    <div id="carregando" class="hide"></div>
</div>


<div class="span11">
<div id="graph"></div>
</div>

<div class="span2">
<div class="stat-box medium-blue">
      <span class="count">{{$mediaPresentes}}%</span>
      <span class="stat-text">Presença</span>
    </div>
</div>

<div class="span2">
<div class="stat-box medium-blue">
      <span class="count">{{$mediaAusentes}}%</span>
      <span class="stat-text">Ausência</span>
    </div>
</div>
{{$texto}}
</div>
</div>
@endsection

@section('othersjs')
{{ HTML::script('js/morris.min.js'); }}
{{ HTML::script('js/raphael.2.1.0.min.js'); }}
{{ HTML::script('js/ajax.js'); }}
<script>
Morris.Line({
  element: 'graph',
  data: {{$dados}},
  xkey: 'data',
  ykeys: ['valor'],
  labels: ['Series A'],
  xLabels: "day"
});
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1D").toggleClass('active');

    var action = $('#form').attr('action')
    var form_data = {
          abreviacao: $('#palestras').val()
    };

    $('#palestras').change(function(e) {
        e.preventDefault();
        form_data = {
          abreviacao: $('#palestras').val()
        };
        teste(action, form_data);
    });

    teste(action, form_data);
});
</script>
@endsection