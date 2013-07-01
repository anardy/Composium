@layout('template.minharea')

@section('title')
- Minha Área
@endsection

@section('conteudo')
@if ($userinscrito < 1)
    {{ HTML::link('inscricao', 'Faça sua Inscrição', array('class' => 'btn btn-large btn-block btn-success')); }}
@endif
@if (($user_pagou == 0) && ($userinscrito > 0))
    {{ HTML::decode(HTML::link('boleto', 'Gerar Boleto', array('class' => 'btn btn-large btn-block btn-success'))); }}
@endif
<h3>Meu Horário</h3>
<table class="table table-hover">
    <tr>
        <th>Horário</th>
        <th>Palestra / Minicurso</th>
        <th>Local</th>
    </tr>
    @foreach ($horario as $h)
        <tr>
            <td>{{ date('d/m - H:i', strtotime($h->data)) }}</td>
            <td>{{ $h->abreviacao }} - {{ $h->nome }}</td>
            <td>{{ $h->local }}</td>                        
        </tr>
    @endforeach
</table>

    <div class="span8">
    @if ($user_pagou == 0)
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
    @endif
@endsection


@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1A").toggleClass('active');
});
</script>
@endsection