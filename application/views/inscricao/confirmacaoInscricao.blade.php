@layout('template.mainsemfooter')

@section('title')
- Inscrição
@endsection

@section('otherscss')
	{{ HTML::style('css/wizard.css') }}
@endsection

@section('content')
<div class="wizard">
	<a><span class="badge">1</span>1º Dia</a>
	<a><span class="badge">2</span>2º Dia</a>
	<a><span class="badge">3</span>3º Dia</a>
	<a class="current"><span class="badge badge-inverse">4</span>Confirmação</a>
</div>

<h3>Detalhes da Inscrição</h3>
<div class="offset2 span8">
<div class="well">
	<table class="table">
		<tbody>
			<tr>
				<td>Taxa de Inscrição</td>
				<td>R$ {{ $taxa }}</td>
			</tr>
			@foreach ($minicursos as $user)
			<tr>
				<td>{{ $user->abreviacao }} - {{$user->nome}}</td>
				@if ($user->abreviacao[0] == 'M')
					<td>R$ {{ $mnicrs }}</td>
				@else
					<td>&nbsp;</td>
				@endif
			</tr>
			@endforeach
			<tr>
				<td><h4>Total</h4></td>
				<td><h4>R$ {{ $total }}</h4></td>
			</tr>
		</tbody>
	</table>
	</div>
	<p>
	{{ HTML::link('minharea', 'Concluir Inscrição', array('class' => 'btn btn-large btn-block btn-success')); }}
</p>
</div>

    <div id="mAnular" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-body">
            <h3>Você tem certeza que deseja anular sua inscrição?</h3>
            {{ HTML::link('anularinscricao', 'Sim', array('class' => 'btn btn-large btn-primary')); }}
            {{ HTML::link('#', 'Não', array('class' => 'btn btn-large btn-primary', 'id' => 'bNaoAnular')); }}
        </div>
    </div>

@endsection

@section('othersjs')
{{ HTML::script('http://twitter.github.com/bootstrap/assets/js/bootstrap-modal.js'); }}
<script>
$(document).ready(function(){
    $("#bAnular").click(function() {
    	$('#mAnular').modal('show');
    });
    $("#bNaoAnular").click(function() {
    	$('#mAnular').modal('hide');
    });
    $("#bHorario").click(function() {
    	$('#userprog').printArea();
	});
});
</script>
@endsection