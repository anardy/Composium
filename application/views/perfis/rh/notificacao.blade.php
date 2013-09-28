@if (Notificacao::count_notificacao_total('rh') > 0)

	@if (Notificacao::count_notificacao_novas('rh') > 0)
	    @foreach (Notificacao::new_notificacao('rh') as $a)
			<li><a href="/">{{$a->mensagem}}</a></li>
		@endforeach
	@endif

	@if (Notificacao::count_notificacao('rh') > 0)
	    @foreach (Notificacao::notificacao_perfil('rh') as $a)
	    	<li><a href="/">{{$a->mensagem}}</a></li>
		@endforeach
		<li class="divider"></li>
	    <li>
	    	<a href="#">Ver todas notificações...</a>
	    </li>
	@endif

	@if (Notificacao::count_notificacao_novas('rh') > 0)
		<?php 
			DB::table('notificacoes')->where('perfil', '=', 'rh')->update(array('status' => '1'))
		?>
	@endif

@else
	<li>Nenhuma Notificação!</li>
@endif


<script>
var total = {{Notificacao::count_notificacao('rh')}};
$(document).ready(function(){
	if (total > 0) {
		$('#nro_notificacoes').hide();
	}
});

</script>