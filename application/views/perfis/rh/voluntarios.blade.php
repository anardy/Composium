@layout('template.rh')

@section('title')
- Voluntários
@endsection

@section('otherscss')
@endsection


@section('conteudo')
<div class="span12">
<h3>Voluntários</h3>
@if ($voluntarios->results)
	{{ Form::open(action('rh@voluntarios')) }}
		<table class="table table-hover">
			<tbody>
				@foreach ($voluntarios->results as $r)
					<tr>
						<td>{{ Form::checkbox('cpfs[]', $r->cpf, false) }}</td>
						<td>{{ $r->cpf }}</td>
						<td>{{ date('d/m/Y à\s H:i', strtotime($r->data)) }}</td>
					</tr>
		        @endforeach
		    </tbody>
		</table>
		<p>{{ Form::submit('Autorizar', array('class' => 'btn btn-large btn btn-success')) }}</p>
	{{ Form::close() }}
	{{ $voluntarios->links(); }}
@else
	<h3>Nenhuma solicitação de Voluntário!!</h3>
@endif
</div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#menu>li').removeClass('active');
    $("#1E").toggleClass('active');
});
</script>
@endsection