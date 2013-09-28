@layout('template.coordenador')

@section('title')
- Coordenador
@endsection

@section('conteudo')
<div class="span12">
	<h3>Contabilidade</h3>
	<div class="row-fluid">
<div class="span9 offset2">
<div class="span3 center">
    <div class="stat-box medium-blue">
      <i class="icon-group icon-large"></i>
      <span class="count">{{$emcaixa}}</span>
      <span class="stat-text">Em caixa</span>
    </div>
</div>
<div class="span3 center">
        <div class="stat-box medium-blue">
      <i class="icon-group icon-large"></i>
      <span class="count">{{$areceber}}</span>
      <span class="stat-text">A receber</span>
    </div>
</div>
<div class="span3 center">
        <div class="stat-box medium-blue">
      <i class="icon-group icon-large"></i>
      <span class="count">134</span>
      <span class="stat-text">A pagar</span>
    </div>
</div>

</div>

<div class="span2 center">
        <div class="stat-box medium-blue">
      <i class="icon-group icon-large"></i>
      <span class="count">134</span>
      <span class="stat-text">Total</span>
    </div>
</div>
</div>
</div>

@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1E").toggleClass('active');

});
</script>
@endsection