@layout('template.minharea')

@section('title')
- Reinscrição
@endsection

@section('conteudo')
<div class="span8 main-content">
        <h2>Solicitação de Reinscrição</h2>
                    <div id="result" class="well hide"></div>
                    @if ($reinscricao > 0)
                        <div class="well">
                            <h4>Status Aguardando...</h4>
                            <p>Assim que sua Reinscrição for autorizada você receberá um e-mail para realizar a Inscrição novamente</p>
                            <p>Dúvidas entre em contato: composium@unifei.edu.com.br</p>
                            <p>Obrigado,</p>
                            <p>Equipe de Organização do III Composium</p>
                        </div>
                    @else
                        <div id="areaSolreins">
                            <p>Caso não esteja satisfeito com a sua inscrição você pode refazê-la.</p>
                            {{ Form::open('reinscricao', '', array('id' => 'solReins')) }}
                                <p>{{ Form::submit('Solicitar Reinscrição', array('class' => 'btn btn-large btn btn-primary')) }}</p>
                            {{ Form::close() }}
                        </div>
                    @endif
</div>
@endsection


@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1F").toggleClass('active');
});
</script>
@endsection