@layout('template.rh')

@section('title')
- RH
@endsection

@section('conteudo-topo')
<div class="span3 stat">
    <div class="data">
        <span class="number">X</span>Usuários
    </div>
    <span class="date">Inscritos</span>
</div>
<div class="span3 stat">
    <div class="data">
        <span class="number">{{$c_users}}</span>Confirmados
    </div>
    <span class="date">???</span>
</div>
<div class="span3 stat">
    <div class="data">
        <span class="number">{{$c_reinscricao}}</span>A pagar
    </div>
    <span class="date">??</span>
</div>
<div class="span3 stat">
    <div class="data">
        <span class="number">{{$c_voluntarios}}</span>Vencidos
    </div>
    <span class="date">??</span>
</div>
@endsection

@section('conteudo')
<div class="span12">
    <div class="row-fluid">
<div class="box span7">
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
                @foreach ($ultimas_realizacoes as $r)
                <li>
                    {{date('d/m/Y à\s H:i', strtotime($r->data))}} - {{$r->oque}}
                </li>
                @endforeach
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
                @foreach ($ultimos_users as $r)
                <li>
                    {{date('d/m/Y à\s H:i', strtotime($r->data))}} - {{$r->firstnome}} {{$r->lastnome}}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@section('othersjs')
<script>
var BASE = "<?php echo URL::base(); ?>";
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1A").toggleClass('active');
    $('#notificar').click(function(e) {
                e.preventDefault();
                if ($('#notificacao').is(':empty')) {
                $.ajax({
                    type: 'GET',
                    url: BASE+'/notificacaoRh',
                    beforeSend: function() {
                        $('#notificacao').html('Carregando...');
                    },
                    success: function(data) {
                        $('#notificacao').html(data);
                    }
         });
       }
    });
});
</script>
@endsection