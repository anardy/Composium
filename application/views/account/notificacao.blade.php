
@if (Notificacao::count_notificacao_user(Auth::user()->cpf) > 0)
    @foreach (Notificacao::notificacao_user(Auth::user()->cpf) as $a)
		<li><a href="/">{{$a->mensagem}}</a></li>
	@endforeach
	<li class="divider"></li>
    <a href="#" style="text-align: right;">Ver todas notificações...</a>
@else
	<li>Nenhuma Notificação!</li>
@endif
