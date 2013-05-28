@layout('template.main')

@section('title')
- Inscrição
@endsection

@section('otherscss')
{{ HTML::style('css/wizard.css') }}
@endsection

@section('content')
<div class="wizard">
	<a class="current"><span class="badge badge-inverse">1</span>Dados Pessoais</a>
	<a><span class="badge">2</span>1º Dia</a>
	<a><span class="badge">3</span>2º Dia</a>
	<a><span class="badge">4</span>3º Dia</a>
	<a><span class="badge">5</span>Confirmação</a>
</div>

<div class="span4">
	{{ Form::open('cadDadosPessoais') }}
		<p>{{ Form::text('nome', Input::old('nome'), array('placeholder' => 'Nome Completo')) }} {{ $errors->first('nome', 'Preenche está merda') }}</p>
		<p>{{ Form::text('username', Input::old('username'), array('placeholder' => 'Username')) }} {{ $errors->first('username', 'Preenche está merda') }}</p>
		<p>{{ Form::password('senha', array('placeholder' => 'Senha')) }} {{ $errors->first('senha', 'Preenche está merda') }}</p>
		<p>{{ Form::text('cpf', Input::old('cpf'), array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-medium')) }} {{ $errors->first('cpf', 'Preenche está merda') }}</p>
		<p>{{ Form::text('telefone', Input::old('telefone'), array('placeholder' => 'Telefone', 'id' => 'telefone', 'class' => 'input-medium')) }} {{ $errors->first('telefone', 'Preenche está merda') }}</p>
		<p>{{ Form::text('matricula', '', array('placeholder' => 'Matrícula', 'class' => 'input-small')) }}</p>
		<p>{{ Form::text('email', Input::old('email'), array('placeholder' => 'E-mail')) }} {{ $errors->first('email', 'Preenche está merda') }}</p>
		<p>{{ Form::select('instituicao', array('UNIFEI' => 'UNIFEI - Itajubá', 'ITABIRA' => 'UNIFEI - Itabira', 'OUTRA' => 'Outra')) }}</p>
		<p>{{ Form::select('curso', array('CCO' => 'Ciência da Computação', 'ECO' => 'Engenharia da Computação', 'SIN' => 'Sistemas de Informação', 'OUT' => 'Outro')) }}</p>
		<p>{{ Form::text('ano', Input::old('ano'), array('placeholder' => 'Ano Ingresso', 'class' => 'input-small')) }} {{ $errors->first('ano', 'Preenche está merda') }}</p>
		<p>{{ Form::select('periodo', array(0 => 'Integral', 1 => 'Diurno', 2 => 'Noturno')) }}</p>
		<p>{{ Form::submit('Próximo &raquo;') }}</p>
	{{ Form::close() }}
</div>

@endsection

@section('othersjs')
{{ HTML::script('js/jquery.masked.min.js'); }}
{{ HTML::script('js/script.inscricao.js'); }}
@endsection