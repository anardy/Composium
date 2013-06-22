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
        <span class="number">Y</span>Usuários
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
<div class="box span6">
    <div class="box-header">
        <h2><i class="icon-signal"></i><span class="break"></span>Últimas Ações</h2>
        <div class="box-icon">
            <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="icon-remove"></i></a>
        </div>
    </div>
    <div class="sparkLineStats">
        <div class="box-content">
            <ul class="unstyled">
                <li>
                    <span class="sparkLineStats1 "></span> Visits: <span class="number">356</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="box span5">
    <div class="box-header">
        <h2><i class="icon-signal"></i><span class="break"></span>Últimos Usuários Inscritos</h2>
        <div class="box-icon">
            <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="icon-remove"></i></a>
        </div>
    </div>
    <div class="sparkLineStats">
        <div class="box-content">
            <ul class="unstyled">
                <li>
                    <span class="sparkLineStats1 "></span> Visits: <span class="number">356</span>
                </li>
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