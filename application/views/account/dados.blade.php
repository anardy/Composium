@layout('template.minharea')

@section('title')
- Minha Área
@endsection

@section('conteudo')
<div class="span12 main-content">
<h2>Meus Dados</h2>
    {{ Form::open(action('minharea@AltDados'), '', array('class' => 'form-horizontal')) }}
    <fieldset>
    <legend>Alteração dos Dados</legend>
        <div class="control-group">
            <label class="control-label">Primeiro nome:</label>
            <div class="controls">
               {{ Form::text('firstnome', $results[0]->firstnome, array('class' => 'input-medium')) }} {{ $errors->first('nome', 'Preenche está merda') }}
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Último nome:</label>
            <div class="controls">
               {{ Form::text('lastnome', $results[0]->lastnome, array('class' => 'input-medium')) }} {{ $errors->first('nome', 'Preenche está merda') }}
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Email:</label>
            <div class="controls">
                {{ Form::text('email', $results[0]->email) }} {{ $errors->first('email', 'Preenche está merda') }}
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Matrícula:</label>
            <div class="controls">
                {{ Form::text('matricula', $results[0]->matricula, array('placeholder' => 'Matrícula', 'class' => 'input-small')) }}
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Instituição:</label>
            <div class="controls">
                {{ Form::select('instituicao', array('UNIFEI' => 'UNIFEI - Itajubá', 'ITABIRA' => 'UNIFEI - Itabira', 'OUTRA' => 'Outra'), $results[0]->instituicao) }}
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Curso:</label>
            <div class="controls">
                {{ Form::select('curso', array('CCO' => 'Ciência da Computação', 'ECO' => 'Engenharia da Computação', 'SIN' => 'Sistemas de Informação', 'OUT' => 'Outro'), $results[0]->curso) }}
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Ano:</label>
            <div class="controls">
                {{ Form::text('ano', $results[0]->ano, array('placeholder' => 'Ano Ingresso', 'class' => 'input-small')) }} {{ $errors->first('ano', 'Preenche está merda') }}
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Período:</label>
            <div class="controls">
                {{ Form::select('periodo', array('INTEGRAL' => 'Integral', 'DIURNO' => 'Diurno', 'NOTURNO' => 'Noturno'), $results[0]->periodo) }}
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                {{ Form::submit('Atualizar', array('class' => 'btn btn-large btn btn-success')) }}
            </div>
        </div>
    </fieldset>
    {{ Form::close() }}

<fieldset>
    <legend>Alterar Senha</legend>
    {{ Form::open('cadDadosPessoais', '', array('class' => 'form-inline')) }}
        <div class="control-group">
            <label>Digite a senha Antiga:</label>
            <div class="controls">
                {{ Form::password('password', array('placeholder' => 'Senha Antiga')) }}
            </div>
        </div>
        <div class="control-group">
            <label>Digite a senha Nova:</label>
            <div class="controls">
                {{ Form::password('password', array('placeholder' => 'Senha Nova')) }}
            </div>
        </div>
        <div class="control-group">
            <label>Redigite a senha Antiga:</label>
            <div class="controls">
                {{ Form::password('password', array('placeholder' => 'Re-digite Senha Nova')) }}
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                {{ Form::submit('Alterar', array('class' => 'btn btn-large btn-primary')) }}
            </div>
        </div>
    {{ Form::close() }}
</fieldset>
<fieldset>
    <legend>Deletar conta</legend>
                <div class="control-group">
                    <div class="controls">
                        {{ Form::submit('Deletar Conta', array('class' => 'btn btn-large btn-danger')) }}
                    </div>
                </div>
                </fieldset>
        </div>
        </div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1H").toggleClass('active');
});
</script>
@endsection