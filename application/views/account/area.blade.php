@layout('template.minharea')

@section('title')
- Minha Área
@endsection

@section('conteudo')
<div class="span12 main-content">
@if (($user_pagou) || ($user_pagou == 1))
<h3>Meu Horário</h3>
<div class="span9 offset1">
<table class="table table-hover table-striped">
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
</div>
@else
    <h2>Minha Área!</h2>
    Você ainda não fez a inscrição no III Composium?<br>
    Não perca tempo e faça agora mesmo!<br>
    BLA BLA
    <p>HA</p>
    {{ HTML::link('inscricao', 'Faça sua Inscrição', array('class' => 'btn btn-large btn-success')); }}
    <p>HA</p>
@endif
</div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1A").toggleClass('active');
});
</script>
@endsection