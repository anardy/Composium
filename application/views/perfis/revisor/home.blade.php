@layout('template.revisor')

@section('title')
- Revisor
@endsection

@section('otherscss')
@endsection

@section('conteudo')
<h3>Artigos</h3>

@if ($msgm === 'aprovado')
	<div class="alert alert-success">
    	Artigo aprovado com Sucesso!
    </div>
@elseif ($msgm === 'reprovado')
	<div class="alert alert-success">
		Artigo reprovado com Sucesso!
	</div>
@endif
<?php Session::forget('revisorartigo');?>
@if ($artigos->results)
	<table class="table table-hover">
		<thead>
			<th>Título</th>
			<th>Data de Envio</th>
			<th>Quem revisou?</th>
			<th>Data Revisão</th>
			<th>Arquivo</th>
			<th>Status</th>
				<th></th>
				<th></th>
		</thead>
		<tbody>
			@foreach ($artigos->results as $a)
				<tr>
					<td><a href="#myModal" role="button" class="tnc" data-toggle="modal" data-id="{{$a->cpf}}">{{ $a->titulo }}</a></td>
					<td>{{ date('d/m/Y à\s H:i', strtotime($a->dataenvio)) }}</td>
					<td>{{$a->firstnome}} {{$a->lastnome}}</td>
					<td>{{$a->datarevisao}}</td>
					<td>{{ HTML::link('../artigos/'.$a->nome_arquivo, 'Download'); }}</td>
					<td>
					@if ($a->status == 0)
						<span class="label label-info">PENDENTE</span>
					@elseif ($a->status == 1)
						<span class="label label-success">APROVADO</span>
					@else
						<span class="label label-important">REPROVADO</span>
					@endif
					</td>
					@if ($a->status == 0)
						<td>
							{{ Form::open(action('revisor@aprovarartigo'), $a->cpf) }}
	                            {{ Form::hidden('cpf',$a->cpf) }}
	                            {{Form::submit('Aprovar', array('class' => 'btn btn-success')) }}
	                        {{ Form::close() }}
						</td>
						<td>
							{{ Form::open(action('revisor@reprovarartigo'), $a->cpf) }}
	                            {{ Form::hidden('cpf',$a->cpf) }}
	                            {{Form::submit('Reprovar', array('class' => 'btn btn-danger')) }}
	                        {{ Form::close() }}
						</td>
					@endif
				</tr>
		       @endforeach
		   </tbody>
	</table>

@else
	<h3>Nenhum Artigo para revisão</h3>
@endif
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Visão Detalhada</h3>
  </div>
  <div class="modal-body">
    <div id="bookId"/>
  </div>
</div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
	$(document).on("click", ".tnc", function () {
	    var myBookId = $(this).data('id');
	    //$(".modal-body #bookId").html( myBookId );
	    $('#myModal').modal('show');
	    $.ajax({
		    type: 'GET',
		    url: BASE+'/revisor/conArtigo/'+myBookId,
		    beforeSend: function() {
		    	$('#bookId').html('Carregando...');
		    },
		    success: function(data) {
		    	$('#bookId').html(data);
		    }
    	});
	});

    $('#dashboard-menu>li').removeClass('active');
    $("#1A").toggleClass('active');
});
</script>
@endsection