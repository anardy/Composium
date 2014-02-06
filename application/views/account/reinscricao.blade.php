@layout('template.minharea')

@section('title')
- Reinscrição
@endsection

@section('conteudo')
<div class="span12 main-content">
    <h2>Solicitação de Reinscrição</h2>
        <div id="result" class="hide"></div>
        @if ($reinscricao > 0)
            @include('account.EnvioReinscricao');
        @else
            <div id="areaSolreins">
                <p>Caso não esteja satisfeito com a sua inscrição você pode refazê-la.</p>
                {{ HTML::link('#', 'Solicitar Reinscrição', array('id' => 'enviar', 'class' => 'btn btn-large btn btn-primary')); }}
            </div>
        @endif
</div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1F").toggleClass('active');

    $(document).on("click", "#enviar", function () {
        $.ajax({
            type: 'POST',
            url: BASE+'/minharea/reinscricao/',
            beforeSend: function() {
                $('#result').html('Carregando...').show();
            },
            success: function(data) {
                $('#areaSolreins').hide();
                $('#result').html(data).show();
            }
        });
    });
});


</script>
@endsection