@if (Notificacao::count_notificacao_total('admin') > 0)

	@if (Notificacao::count_notificacao_novas('admin') > 0)
	    @foreach (Notificacao::new_notificacao('admin') as $a)
			<li><a href="/">{{$a->mensagem}}</a></li>
		@endforeach
	@endif

	@if (Notificacao::count_notificacao('admin') > 0)
	    @foreach (Notificacao::notificacao_perfil('admin') as $a)
	    	<li><a href="/">{{$a->mensagem}}</a></li>
		@endforeach
		<li class="divider"></li>
	    <li>
	    	<a href="#">Ver todas notificações...</a>
	    </li>
	@endif

	@if (Notificacao::count_notificacao_novas('admin') > 0)
		<?php 
			DB::table('notificacoes')->where('perfil', '=', 'admin')->update(array('status' => '1'));
		?>
	@endif

@else
	<li>Nenhuma Notificação!</li>
@endif

<script>
var total = {{Notificacao::count_notificacao('admin')}};
$(document).ready(function(){
	if (total > 0) {
		$('#nro_notificacoes').hide();
	}
});
</script>