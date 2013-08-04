@if ($participantes)
{{ HTML::link('imprimirListaPresenca/'.$palestra[0]->abreviacao, 'Imprimir Lista de Presença', array('class' => 'btn btn-primary pull-right')); }}
<div class="span6">
{{ Form::open('atuPresenca') }}
<table class="table table-hover">
	<h5>Título: {{$palestra[0]->nome}}</h5>
	<h5>Palestrante: 
		@if ($palestra[0]->palestrante)
			{{$palestra[0]->palestrante}}
		@else
			-
		@endif
	</h5>
	<h5>Local: {{$palestra[0]->local}}</h5>
	<h5>Data: {{ date('d/m/Y à\s H:i', strtotime($palestra[0]->data)) }}</h5>

	@foreach ($participantes as $p)
		<tr>
			<td style="width: 5%">
				@if ($p->presenca == 0)
					{{ Form::checkbox('participantes[]', $p->cpf, false) }}
				@else 
					{{ Form::checkbox('participantes[]', $p->cpf, true) }}
				@endif
			</td>
			<td>{{ $p->firstnome }} {{ $p->lastnome }}</td>
		</tr>
	@endforeach
</table>
	<p>{{ Form::submit('Atualizar', array('class' => 'btn btn-large btn btn-success')) }}</p>
	{{ Form::hidden('abreviacao', $palestra[0]->abreviacao) }}
{{ Form::close() }}
</div>
@else
	<h3>Nenhum inscrito!</h3>
@endif