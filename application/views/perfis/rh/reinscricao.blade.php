@layout('template.rh')

@section('title')
- Reinscrição
@endsection

@section('conteudo')
@if ($reinscricoes->results)
<div class="span6 offset3">
    {{ Form::open('buscaAutReinscricao', 'busca', array('class' => 'form-inline')) }}
        {{ Form::text('nome', '', array('placeholder' => 'Digite o Nome', 'class' => 'input-xlarge')) }}
        {{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
	{{ Form::open('autReinscricao') }}
		<table class="table table-hover">
	        <thead>
	            <th>&nbsp;</th>
	            <th>Nome</th>
	            <th>E-mail</th>
	            <th>Quantidade Solicitações</th>
	            <th>Data Solicitação</th>
	        </thead>
			<tbody>
				@foreach ($reinscricoes->results as $r)
					@foreach (Reinscricao::get_reinscricoes_teste($r->cpf) as $t)
					<tr>
						<td>{{ Form::checkbox('reinscricao[]', $r->cpf, false) }}</td>
						<td>{{ $r->firstnome }} {{$r->lastnome}}</td>
						<td>{{ $r->email }}</td>
						<td>{{ $t->qnt }}</td>
						<td>{{ date('d/m/Y à\s H:i', strtotime($r->data)) }}</td>
					</tr>
					@endforeach
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