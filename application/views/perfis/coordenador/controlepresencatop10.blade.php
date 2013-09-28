<table class="table table-hover">
		<thead>
			<th>Palestra</th>
			<th>Presentes</th>
			<th>Ausentes</th>
			<th>Percentual</th>
			<th>Status</th>
		</thead>
		<tbody>
			@foreach ($dados as $d)
				<?php
					$presentes = Presenca::get_presentes($d->abreviacao);
					$ausentes = Presenca::get_ausentes($d->abreviacao);
					$total = Presenca::nrototal_abreviacao($d->abreviacao);
					$percentual = ($presentes * 100)/$total;
				?>
				<tr>
					<td>{{$d->abreviacao}} - {{$d->nome}}</a></td>
					<td>{{$presentes}}</a></td>
					<td>{{$ausentes}}</td>
					<td>{{round($percentual)}}%</td>
				</tr>
			@endforeach
		</tbody>
</table>