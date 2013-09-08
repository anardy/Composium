@layout('template.revisor')

@section('title')
- Revisor
@endsection

@section('otherscss')
@endsection

@section('conteudo')
<h3>Artigos</h3>
@if ($msgm)
    <div class="alert alert-success">  
        Artigo autorizado com Sucesso!
    </div>
@endif
<?php Session::forget('revisorartigo');?>
@if ($artigos->results)
	<table class="table table-hover">
		<thead>
			<th>Título</th>
			<th>Data de Envio</th>
			<th></th>
			<th></th>
			<th>Quem revisou?</th>
			<th>Data Revisão</th>
			<th>Rating</th>
		</thead>
		<tbody>
			@foreach ($artigos->results as $a)
				<tr>
					<td><a href="conArtigo/{{$a->cpf}}">{{ $a->titulo }}</a></td>
					<td>{{ date('d/m/Y à\s H:i', strtotime($a->data)) }}</td>
					<td>TESTE</td>
					<td>TESTE</td>
					<td>TESTE</td>
					<td>{{ HTML::link('../artigos/'.$a->nome_arquivo, 'Download'); }}</td>
					@if ($a->status == 0)
						<td>
							{{ Form::open('aprovarartigo', $a->cpf) }}
                                {{ Form::hidden('cpf', $a->cpf) }}
                                {{Form::submit('Aprovar', array('class' => 'btn btn-success')) }}
                            {{ Form::close() }}
                        </td>
					@else
						<td><span class="label label-success">APROVADO</span></td>
					@endif
				</tr>
		       @endforeach
		   </tbody>
	</table>
	{{ $artigos->links(); }}
@else
	<h3>Nenhum Artigo para revisão</h3>
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