@layout('template.rh')

@section('title')
- Reinscrição
@endsection

@section('conteudo')
<h2>Reinscrição</h2>
@if ($reinscricoes)
	{{ Form::open('autReinscricao') }}
		<table class="table table-hover">
			<tbody>
				@foreach ($reinscricoes->results as $r)
					<tr>
						<td>{{ Form::checkbox('reinscricao[]', $r->cpf, false) }}</td>
						<td>{{ $r->cpf }}</td>
						<td>{{ date('d/m/Y à\s H:i', strtotime($r->data)) }}</td>
					</tr>
		        @endforeach
		    </tbody>
		</table>
		<p>{{ Form::submit('Autorizar', array('class' => 'btn btn-large btn btn-success')) }}</p>
	{{ Form::close() }}
	{{ $reinscricoes->links(); }}
@else
	<h3>Nenhuma solicitação de Reinscrição!!</h3>
@endif
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#menu>li').removeClass('active');
    $("#1D").toggleClass('active');
});
</script>
@endsection