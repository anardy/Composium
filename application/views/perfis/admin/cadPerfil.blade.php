@layout('template.administrador')

@section('title')
- Cadastrar Perfil
@endsection

@section('conteudo')
<h4>Cadastrar Perfil</h4>
{{ Form::open('cadPerfil') }}
	<p>{{ Form::text('cpf', Input::old('cpf'), array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-medium')) }} {{ $errors->first('cpf', 'Preenche está merda') }}</p>
	<p>{{ Form::select('perfil', array('Administrador' => 'Administrador', 'Coordenador' => 'Coordenador', 'RH' => 'RH', 'Revisor' => 'Revisor', 'Voluntário' => 'Voluntário'), null, array('id' => 'perfil')) }}</p>
	<p>{{ Form::submit('Cadastrar', array('class' => 'btn btn-large btn btn-success')); }}</p>
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