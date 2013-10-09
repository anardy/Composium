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
			<th>Quem revisou?</th>
			<th>Data Revisão</th>
			<th>Arquivo</th>
			<th>Status</th>
			<th>Rating</th>
		</thead>
		<tbody>
			@foreach ($artigos->results as $a)
				<tr>
					<td><a href="#myModal" role="button" class="tnc" data-toggle="modal" data-id="{{$a->cpf}}">{{ $a->titulo }}</a></td>
					<td>{{ date('d/m/Y à\s H:i', strtotime($a->data)) }}</td>
					<td>Quem revisou</td>
					<td>Data Revisão</td>
					<td>{{ HTML::link('../artigos/'.$a->nome_arquivo, 'Download'); }}</td>
					@if ($a->status == 0)
						<td>
							{{ Form::open(action('revisor@aprovarartigo'), $a->cpf) }}
                                {{ Form::hidden('cpf',$a->cpf) }}
                                {{Form::submit('Aprovar', array('class' => 'btn btn-success')) }}
                            {{ Form::close() }}
                        </td>
					@else
						<td><span class="label label-success">APROVADO</span></td>
					@endif
					<td><div id="raty"></div></td>
				</tr>
		       @endforeach
		   </tbody>
	</table>
	{{ $artigos->links(); }}
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
{{ HTML::script('js/jquery.raty.min.js'); }}
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
var teste;
$('#raty').raty({
  starOff: '../img/star-off.png',
  iconRange: [
    { range: 1, on: '../img/star-on.png' },
    { range: 2, on: '../img/star-on.png' },
    { range: 3, on: '../img/star-on.png' },
    { range: 4, on: '../img/star-on.png' },
    { range: 5, on: '../img/star-on.png' }
  ],
  hints: ['0-10', '11-30', '31-50', '51-80', '81-100'],
  click: function(score, evt) {
    teste = score;
  }
});
$('#raty').click(function() {
	console.log(teste);
});
    $('#dashboard-menu>li').removeClass('active');
    $("#1A").toggleClass('active');
});
</script>
@endsection