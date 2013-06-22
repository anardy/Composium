@layout('template.minharea')

@section('title')
- Minha Área
@endsection

@section('conteudo')
{{ Form::open('cadDadosPessoais', 'account') }}
    <p>{{ Form::text('firstnome', $results[0]->firstnome, array('placeholder' => 'Primeiro Nome', 'class' => 'input-medium')) }} {{ $errors->first('nome', 'Preenche está merda') }}
        {{ Form::text('lastnome', $results[0]->lastnome, array('placeholder' => 'Último Nome', 'class' => 'input-medium')) }} {{ $errors->first('nome', 'Preenche está merda') }}</p>
    <p>{{ Form::text('cpf', $results[0]->cpf, array('placeholder' => 'CPF', 'id' => 'aCpf', 'class' => 'input-medium')) }} {{ $errors->first('cpf', 'Preenche está merda') }}</p>
    <p>{{ Form::password('senha', array('placeholder' => 'Senha')) }} {{ $errors->first('senha', 'Preenche está merda') }}</p>
    <p>{{ Form::text('email', $results[0]->email, array('placeholder' => 'E-mail')) }} {{ $errors->first('email', 'Preenche está merda') }}</p>
    <p>{{ Form::text('matricula', $results[0]->matricula, array('placeholder' => 'Matrícula', 'class' => 'input-small')) }}</p>
    <p>{{ Form::select('instituicao', array('UNIFEI' => 'UNIFEI - Itajubá', 'ITABIRA' => 'UNIFEI - Itabira', 'OUTRA' => 'Outra'), $results[0]->instituicao) }}</p>
    <p>{{ Form::select('curso', array('CCO' => 'Ciência da Computação', 'ECO' => 'Engenharia da Computação', 'SIN' => 'Sistemas de Informação', 'OUT' => 'Outro'), $results[0]->curso) }}</p>
    <p>{{ Form::text('ano', $results[0]->ano, array('placeholder' => 'Ano Ingresso', 'class' => 'input-small')) }} {{ $errors->first('ano', 'Preenche está merda') }}</p>
    <p>{{ Form::select('periodo', array('INTEGRAL' => 'Integral', 'DIURNO' => 'Diurno', 'NOTURNO' => 'Noturno'), $results[0]->periodo) }}</p>
    <p>{{ Form::submit('Atualizar', array('class' => 'btn btn-large btn btn-success')) }}</p>
    @if (isset($praonde))
        {{ Form::hidden('praonde', $praonde) }}
    @endif
    {{ Form::close() }}
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1F").toggleClass('active');
});
</script>
@endsection