@layout('template.coordenador')

@section('title')
- Coordenador
@endsection

@section('conteudo')
<div class="span12">
	<h3>Orçamento</h3>
	<div class="row-fluid">
{{ HTML::link('#', '+ Orçamento', array('class' => 'btn btn-primary pull-right')); }}
     <table class="table">
        <thead>
            <th>#</th>
            <th>Empresa</th>
            <th>Total Orçado</th>
            <th>Total Pago</th>
            <th>Status</th>
        </thead>
        <tbody>
        </tbody>
    </table>

</div>
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