@layout('template.mainsemfooter')

@section('title')
- Presença
@endsection

@section('content')
<div class="span12">
	<p>Título: {{$palestra[0]->nome}} / Palestrante: {{$palestra[0]->palestrante}}</p>
	<p>Local: {{$palestra[0]->local}}</p>
	<p>Data: {{ date('d/m/Y à\s H:i', strtotime($palestra[0]->data)) }}</p>

	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Nome</th>
			<th>Assinatura</th>
		</thead>
		<tbody>
	<?php $i = 1; ?>
	@foreach ($participantes as $p)
		<tr>
			<td style="width: 5%">{{ $i++ }}</td>
			<td style="width: 30%">{{ $p->firstnome }} {{ $p->lastnome }}</td>
			<td>&nbsp;</td>
		</tr>
	@endforeach
		</tbody>
	</table>
</div>
@endsection