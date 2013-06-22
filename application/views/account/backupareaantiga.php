<div class="span12">
@if ($userinscrito > 0)
    
        @if ($userinscrito < 1)
                {{ HTML::link('inscricao', 'Faça sua Inscrição', array('class' => 'btn btn-large btn-block btn-success')); }}
        @endif
        @if (($user_pagou == 0) && ($userinscrito > 0))

                {{ HTML::decode(HTML::link('boleto', 'Gerar Boleto', array('class' => 'btn btn-large btn-block btn-success'))); }}
        @endif
        @if ($userinscrito > 0)
            <h2>Situação da Inscrição</h2>
            @if ($user_pagou == 0)
                <div class="alert alert-error">
                        <h4>NÃO CONFIRMADO</h4>
                        <p>Caso já tenha realizado o pagamento <strong>aguarde</strong> em breve atualizaremos a sua situação.</p>
                        <p>Se não for atualizado no prazo de 24 horas, envie um e-mail para: composium@unifei.edu.br</p>
                    </div>
                @else 
                    <div class="alert alert-success">
                        <h4>CONFIRMADO</h4>
                        <p>Obrigado por participar do II Composium Simpósio de Computação da Universidade Federal de Itajubá.</p>
                    </div>
                @endif
                <div class="alert alert-block">
                    <h4>BOLETO VENCIDO!</h4>
                    <p>Refaça a sua inscrição</p>
                </div>
        @endif
    @if ($user_pagou == 0) 

    @endif
@endif

<section id="artigo">

</section>
</div>

@endsection

@section('othersjs')
{{ HTML::script('js/RGraph.common.core.js'); }}
{{ HTML::script('js/RGraph.meter.js'); }}
<script>
var userinscrito = {{$userinscrito}};
$(document).ready(function(){
    $("#menu").find('a').on('click', function (event) {
        var $this = $(this),
            $htmlBody = $('html, body'),
            linkTarget = $this.attr('href'),
            offSetTop;

        // If not start with #, stop here!
        if (linkTarget[0] !== '#') {
            return false;
        }
        event.preventDefault();
        offSetTop = $(linkTarget).offset().top;
        $htmlBody.stop().animate({ scrollTop: offSetTop }, function () {
            location.hash = linkTarget;
        });
    });

    if (userinscrito > 0) {
        var meter2 = new RGraph.Meter('media', 0,100,{{$media_user}})
        .Set('red.start', 0)
        .Set('red.end', 30)
        .Set('yellow.start', 30)
        .Set('yellow.end', 70)
        .Set('green.start', 70)
        .Set('green.end', 100)
        .Draw();
    }

    $('#solReins').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: action,
            beforeSend: function() {
                $('#areaSolreins').fadeOut();
            },
            success: function(response) {
                $('#result').html(response).fadeIn();
            }
        });
    });
});
</script>
@endsection