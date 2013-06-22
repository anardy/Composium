@layout('template.minharea')

@section('title')
- Minha Área
@endsection

@section('conteudo')
<h3>Teste</h3>
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
<div class="span5">
<h2>Controle de Presença</h2>
                <table class="table table-hover">
                    <tr>
                        <th>Palestra / Minicurso</th>
                        <th>Status</th>
                    </tr>
                    @foreach ($controle_presenca as $d)
                        <tr>
                            <td>{{ $d->abreviacao }} - {{ $d->nome }}</td>
                            @if ($d->presenca == 0)
                                <td><i class="icon-remove"></i></td>
                            @else
                                <td><i class="icon-ok"></i></td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="span4">
                <h4 style="margin-left:110px;">Média de Presença</h4>
            </div>
    </div>
    <div class="span12">
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