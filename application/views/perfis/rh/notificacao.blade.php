@if (Notificacao::count_notificacao_total_rh() > 0)

	@if (Notificacao::count_notificacao_novas_rh() > 0)
	    @foreach (Notificacao::new_notificacao_rh() as $a)
			<li><a href="/">{{$a->mensagem}}</a></li>
		@endforeach
	@endif

	@if (Notificacao::count_notificacao_rh() > 0)
	    @foreach (Notificacao::notificacao_rh() as $a)
	    	<li><a href="/">{{$a->mensagem}}</a></li>
		@endforeach
		<li class="divider"></li>
	    <li>
	    	<a href="#">Ver todas notificações...</a>
	    </li>
	@endif

	@if (Notificacao::count_notificacao_novas_rh() > 0)
		<?php 
			DB::table('notificacoes')->where('perfil', '=', 'rh')->update(array('status' => '1'))
		?>
	@endif

@else
	<li>Nenhuma Notificação!</li>
@endif


<script>
var total = {{Notificacao::count_notificacao_rh()}};
$(document).ready(function(){
	if (total > 0) {
		$('#nro_notificacoes').hide();
	}
});

</script>