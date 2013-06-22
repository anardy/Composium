@layout('template.mainsemfooter')

@section('title')
- Acesso
@endsection


@section('content')
<div class="container">
    <div class="row-fluid">
        <h2 class="page-header">Acesso ao Composium</h2>
       	<div class="span12">
           	<div class="span4">
                @if (Session::has('login_errors'))
                    <div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Usuário ou Senha incorretos.
                    </div>
                @endif
                {{ Form::open('login') }}
                    <h4 class="form-heading">Log In</h4>
                    <p>{{ Form::text('cpf', '', array('placeholder' => 'CPF', 'id' => 'lCpf')) }}</p>
                    <p>{{ Form::password('password', array('placeholder' => 'Senha')) }}</p>
                    <p>{{ Form::submit('Logar', array('class' => 'btn btn-large btn btn-success')) }}</p>
                    <label>&raquo; <a href="#">Esqueceu sua senha?</a></label>
                {{ Form::close() }}
	       	</div>
            <div class="span6 offset2">
                {{ Form::open('cadDadosPessoais', 'account') }}
                    <h4 class="form-heading">Criar Conta</h4>
                            <p>{{ Form::text('firstnome', Input::old('firstnome'), array('placeholder' => 'Primeiro Nome', 'class' => 'input-medium')) }} {{ $errors->first('nome', 'Preenche está merda') }}
                                {{ Form::text('lastnome', Input::old('lastnome'), array('placeholder' => 'Último Nome', 'class' => 'input-medium')) }} {{ $errors->first('nome', 'Preenche está merda') }}</p>
                            <p>{{ Form::text('cpf', Input::old('cpf'), array('placeholder' => 'CPF', 'id' => 'aCpf', 'class' => 'input-medium')) }} {{ $errors->first('cpf', 'Preenche está merda') }}</p>
                            <p>{{ Form::password('senha', array('placeholder' => 'Senha')) }} {{ $errors->first('senha', 'Preenche está merda') }}</p>
                            <p>{{ Form::text('email', Input::old('email'), array('placeholder' => 'E-mail')) }} {{ $errors->first('email', 'Preenche está merda') }}</p>
                            <p>{{ Form::text('matricula', '', array('placeholder' => 'Matrícula', 'class' => 'input-small')) }}</p>
                            <p>{{ Form::select('instituicao', array('UNIFEI' => 'UNIFEI - Itajubá', 'ITABIRA' => 'UNIFEI - Itabira', 'OUTRA' => 'Outra')) }}</p>
                            <p>{{ Form::select('curso', array('CCO' => 'Ciência da Computação', 'ECO' => 'Engenharia da Computação', 'SIN' => 'Sistemas de Informação', 'OUT' => 'Outro')) }}</p>
                            <p>{{ Form::text('ano', Input::old('ano'), array('placeholder' => 'Ano Ingresso', 'class' => 'input-small')) }} {{ $errors->first('ano', 'Preenche está merda') }}</p>
                            <p>{{ Form::select('periodo', array(0 => 'Integral', 1 => 'Diurno', 2 => 'Noturno')) }}</p>
                            <p>{{ Form::submit('Criar Conta', array('class' => 'btn btn-large btn btn-success')) }}</p>
                            @if (isset($praonde))
                                {{ Form::hidden('praonde', $praonde) }}
                            @endif
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('othersjs')
{{ HTML::script('http://twitter.github.com/bootstrap/assets/js/bootstrap-alert.js'); }}
{{ HTML::script('js/jquery.masked.min.js'); }}
<script>
    $(document).ready(function(){
    $("#lCpf").inputmask("mask", {"mask": "999.999.999-99"});
    $("#aCpf").inputmask("mask", {"mask": "999.999.999-99"});
});
</script>
@endsection