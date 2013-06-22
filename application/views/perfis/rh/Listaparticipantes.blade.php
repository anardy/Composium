<hr>
@if (!isset($participantes[0]->firstnome))
	<h3>Nenhum inscrito!</h3>
@else
<div class="row">
	<div class="span6 offset3">
	<p>{{ HTML::link('inscricao', 'Imprimir Lista', array('class' => 'btn btn-large btn-block btn-primary')); }}</p>
</div>
<div class="span12">
	<p>Título: {{$info_palestras[0]->nome}} / Palestrante: {{$info_palestras[0]->palestrante}}</p>
	<p>Local: {{$info_palestras[0]->local}}</p>
	<p>Data: {{$info_palestras[0]->dia}} {{$info_palestras[0]->hora}}</p>

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
			<td style="width: 20%">{{ $p->firstnome }} {{ $p->lastnome }}</td>
			<td>&nbsp;</td>
		</tr>
	@endforeach
		</tbody>
	</table>
</div>
</div>
@endif