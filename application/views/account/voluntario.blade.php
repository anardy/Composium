@layout('template.minharea')

@section('title')
- Voluntário
@endsection

@section('conteudo')
<div class="span12 main-content">
    <h3>Voluntário</h3>
    @if (!$voluntario)
            <div class="span5">
                {{ Form::open(action('minharea@voluntario'), '', array('class' => 'form-horizontal')) }}
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Primeira Opção:</label>
                        <div class="controls">
                            {{ Form::select('primeiraopcao', array('0' => 'Selecione..', '1' => 'Apoio Palestras/Minicursos', '2' => 'Equipe de Material', '3' => 'Equipe de Pagamento', '4' => 'Equipe Som/Áudio')) }}
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Segunda Opção:</label>
                        <div class="controls">
                            {{ Form::select('segundaopcao', array('0' => 'Selecione..', '1' => 'Apoio Palestras/Minicursos', '2' => 'Equipe de Material', '3' => 'Equipe de Pagamento', '4' => 'Equipe Som/Áudio')) }}
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Terceira Opção:</label>
                        <div class="controls">
                            {{ Form::select('terceiraopcao', array('0' => 'Selecione..', '1' => 'Apoio Palestras/Minicursos', '2' => 'Equipe de Material', '3' => 'Equipe de Pagamento', '4' => 'Equipe Som/Áudio')) }}
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            {{ Form::submit('Candidatar-se', array('class' => 'btn btn-large btn btn-success')) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>

            <div class="span6">
                <div class="alert alert-info">
                    <i class="icon-lightbulb icon-2x pull-left"></i>
                    <h5>Benéficios de ser um voluntário:</h5>
                    <ul class="unstyled">
                        <ul>
                            <li>Não paga a taxa de inscrição</li>
                            <li>Ganha hora na atividade complementar</li>
                            <li>Participa de uma evento na univerdade</li>
                        </ul>
                    </ul>
                </div>
                <div class="alert alert-info">
                    <i class="icon-puzzle-piece icon-2x pull-left"></i>
                    <h5>Como funciona?</h5>
                    <p>Preencha o fomrulário com a opção que mais deseja trabalhar. Após o preenchimento é só aguardar a aprovação.</p>
                    <p>Essa aprovação chegará via <strong>e-mail</strong> e por notificação na sua área aqui no site. A notificação alertará em quais das opções você foi aceito. Lembrando que você pode ser aceito em mais de uma opção!</p>
                    <p>Com a aprovação, você terá acesso ao espaço de voluntário onde você encontrará a sua escala de trabalho no evento, além de mensagens de convoção!</p>
                    <p>Observação: Sua escala de trabalho não irá atrapalhar seus horários de palestras ou minicursos do evento.</p>
                </div>
            </div>
        </div>
    @else
        @if ($voluntario[0]->status == 1)
            <h1>VOCÊ SE FUDEU</h1>
        @elseif ($voluntario[0]->status == 0)
            <h1>AGUARDANDO</h1>
        @endif
    @endif
</div>
@endsection
<?php Session::forget('artigo');?>

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1E").toggleClass('active');
});
</script>
@endsection