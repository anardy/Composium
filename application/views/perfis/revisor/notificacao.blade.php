@if (Notificacao::count_notificacao_total('revisor') > 0)

	@if (Notificacao::count_notificacao_novas('revisor') > 0)
	    @foreach (Notificacao::new_notificacao('revisor') as $a)
			<li><a href="/">{{$a->mensagem}}</a></li>
		@endforeach
	@endif

	@if (Notificacao::count_notificacao('revisor') > 0)
	    @foreach (Notificacao::notificacao_perfil('revisor') as $a)
	    	<li><a href="/">{{$a->mensagem}}</a></li>
		@endforeach
		<li class="divider"></li>
	    <li>
	    	<a href="#">Ver todas notificações...</a>
	    </li>
	@endif

	@if (Notificacao::count_notificacao_novas('revisor') > 0)
		<?php 
			DB::table('notificacoes')->where('perfil', '=', 'revisor')->update(array('status' => '1'));
		?>
	@endif

@else
	<li>Nenhuma Notificação!</li>
@endif

<script>
var total = {{Notificacao::count_notificacao('revisor')}};
$(document).ready(function(){
	if (total > 0) {
		$('#nro_notificacoes').hide();
	}
});
</script>