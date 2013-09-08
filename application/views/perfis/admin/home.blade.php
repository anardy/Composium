@layout('template.administrador')

@section('title')
- Administrador
@endsection

@section('conteudo-topo')
<div class="span3 stat">
    <div class="data">
        <span class="number">X</span>visitas
    </div>
    <span class="date">??</span>
</div>
<div class="span3 stat">
    <div class="data">
        <span class="number">{{$c_users}}</span>Usuários
    </div>
    <span class="date">Inscritos</span>
</div>
<div class="span3 stat">
    <div class="data">
        <span class="number">X</span>??
    </div>
    <span class="date">??</span>
</div>
<div class="span3 stat">
    <div class="data">
        <span class="number">X</span>??
    </div>
    <span class="date">???</span>
</div>
@endsection

@section('conteudo')
<div class="box span7">
    <div class="box-header">
        <h2><i class="icon-signal"></i><span class="break"></span>Últimas Ações</h2>
    </div>
    <div class="sparkLineStats">
        <div class="box-content">
            <ul class="unstyled">
                @foreach ($ultimas_realizacoes as $r)
                <li>
                    {{date('d/m à\s H:i', strtotime($r->data))}} - {{$r->oque}} ({{$r->quem}})
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="box span5">
    <div class="box-header">
        <h2><i class="icon-signal"></i><span class="break"></span>Últimos Inscritos</h2>
    </div>
    <div class="sparkLineStats">
        <div class="box-content">
            <ul class="unstyled">
                @foreach ($ultimos_users as $r)
                <li>
                    {{date('d/m/Y à\s H:i', strtotime($r->data))}} - {{$r->firstnome}} {{$r->lastnome}}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
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