@if (!isset($participantes[0]->firstnome))
	<h3>Nenhum inscrito!</h3>
@else
	<table class="table table-hover">
	@foreach ($participantes as $p)
		<tr>
			<td>{{ Form::checkbox('reinscricao', $p->firstnome, false) }}</td>
			<td>{{ $p->firstnome }}</td>
		</tr>
	@endforeach
	</table>
@endif