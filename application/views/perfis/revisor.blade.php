@layout('template.revisor')

@section('title')
- Revisor
@endsection

@section('otherscss')
@endsection

@section('conteudo')
@if ($total_artigos <= 0)
	<h3>Nenhum Artigo para revisão</h3>
@else
	<table class="table table-hover">
		<thead>
			<th>Título</th>
			<th>Data de Envio</th>
			<th></th>
			<th></th>
			<th>Data Revisão</th>
		</thead>
		<tbody>
			@foreach ($artigos as $a)
				<tr>
					<td>{{ $a->titulo }}</td>
					<td>{{ date('d/m/Y à\s H:i', strtotime($a->data)) }}</td>
					<td>{{ HTML::link('../artigos/'.$a->nome_arquivo, 'Revisar', array('class' => 'btn btn-primary btn-large')); }}</td>
					@if ($a->status == 0)
						<td>{{ HTML::link('#', 'Autorizar', array('class' => 'btn btn-primary btn-large')); }}</td>
					@else
						<td>Autorizado</td>
					@endif
					<td>TESTE</td>
				</tr>
		       @endforeach
		   </tbody>
	</table>
@endif
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1A").toggleClass('active');
});
</script>
@endsection