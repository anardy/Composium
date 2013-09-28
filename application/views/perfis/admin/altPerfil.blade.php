{{ Form::open(action('administrador@AltPerfil')) }}
	{{ Form::hidden('cpf',$cpf) }}
    {{ Form::hidden('perfilantigo',$perfil) }}
    Colocar o Nome do Usuário
	<p>{{ Form::select('perfilnovo', array('Administrador' => 'Administrador', 'Coordenador' => 'Coordenador', 'RH' => 'RH', 'Revisor' => 'Revisor', 'Voluntario' => 'Voluntario'), $perfil) }}</p>
	<p>{{ Form::submit('Alterar', array('class' => 'btn btn-large btn btn-success')); }}</p>
{{ Form::close() }}