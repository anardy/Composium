<div class="span12">
@if ($userinscrito > 0)
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