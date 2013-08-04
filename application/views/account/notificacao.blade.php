@if (Notificacao::count_notificacao_total_user(Auth::user()->cpf) > 0)

	@if (Notificacao::count_notificacao_novas_user(Auth::user()->cpf) > 0)
	    @foreach (Notificacao::new_notificacao_user(Auth::user()->cpf) as $a)
			<li><a href="/">{{$a->mensagem}}</a></li>
		@endforeach
	@endif

	@if (Notificacao::count_notificacao_user(Auth::user()->cpf) > 0)
	    @foreach (Notificacao::notificacao_user(Auth::user()->cpf) as $a)
	    <li><a href="/">{{$a->mensagem}}</a></li>
		@endforeach
		<li class="divider"></li>
	    <li>
	    			<a href="#">Ver todas notificações...</a>
	    </li>
	@endif

	@if (Notificacao::count_notificacao_novas_user(Auth::user()->cpf) > 0)
		<?php 
			DB::table('notificacoes')->where('destinatario', '=', Auth::user()->cpf)->update(array('status' => '1'))
		?>
	@endif

@else
	<li>Nenhuma Notificação!</li>
@endif


<script>
var total = {{Notificacao::count_notificacao_user(Auth::user()->cpf)}};
$(document).ready(function(){
	if (total > 0) {
		$('#nro_notificacoes').hide();
	}
});

</script>