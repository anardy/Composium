@layout('template.administrador')

@section('title')
- Alterar Perfil
@endsection

@section('conteudo')
<h4>Alterar Perfil</h4>
	<div class="well hide"></div>
	<div id="carregando" class="hide"></div>
	{{ Form::open('altPerfil') }}
		{{ Form::hidden('cpf',$cpf) }}
        {{ Form::hidden('perfilantigo',$perfil) }}
		<p>{{ Form::select('perfilnovo', array('Administrador' => 'Administrador', 'Coordenador' => 'Coordenador', 'RH' => 'RH', 'Revisor' => 'Revisor', 'Voluntário' => 'Voluntário'), $perfil) }}</p>
		<p>{{ Form::submit('Alterar', array('class' => 'btn btn-large btn btn-success')); }}</p>
	{{ Form::close() }}
@endsection

@section('othersjs')
{{ HTML::script('js/jquery.masked.min.js'); }}
<script>
$("#cpf").inputmask("mask", {"mask": "999.999.999-99"});
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1B").toggleClass('active');
});
</script>
@endsection