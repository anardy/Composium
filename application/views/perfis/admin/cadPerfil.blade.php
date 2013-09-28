<div class="row-fluid">
	{{ Form::open(action('administrador@CadPerfil')) }}
		<p>{{ Form::text('cpf', Input::old('cpf'), array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-medium')) }} {{ $errors->first('cpf', 'Preenche está merda') }}</p>
		<p>{{ Form::select('perfil', array('Administrador' => 'Administrador', 'Coordenador' => 'Coordenador', 'RH' => 'RH', 'Revisor' => 'Revisor', 'Voluntario' => 'Voluntário'), null, array('id' => 'perfil')) }}</p>
		<p>{{ Form::submit('Cadastrar', array('class' => 'btn btn-large btn btn-success')); }}</p>
	{{ Form::close() }}
</div>