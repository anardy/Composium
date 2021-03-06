@layout('template.minharea')

@section('title')
- Certificados
@endsection

@section('conteudo')
<div class="span12 main-content">
  <h2>Certificados</h2>
    @if ($certificados)
    	@foreach ($certificados as $c)
       		@if ($c->abreviacao[0] == 'M')
       			<h5><i class="icon-bookmark"></i> Certificado do Minucurso: {{$c->abreviacao . " - " . $c->nome}}</h5>
       		@endif
       	@endforeach
    	@if ($total_presenca_user == $total_user)
    		<h5><i class="icon-bookmark"></i> <a href="certParticipacao">Certificado de Participação</a></h5>
    	@endif
    	<h5><i class="icon-bookmark"></i> <a href="#">Certificado Voluntário</a></h5>
      <h5><i class="icon-bookmark"></i> <a href="#">Certificado Artigo</a></h5>
    @else
    	<h4>Você não tem nenhum certificado</h4>
    @endif
</div>
@endsection


@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1D").toggleClass('active');
});
</script>
@endsection