@layout('template.main')

@section('title')
- Inscrição
@endsection

@section('otherscss')
{{ HTML::style('css/wizard.css') }}
@endsection

@section('content')
<div class="wizard">
	<a><span class="badge">1</span>Dados Pessoais</a>
	<a><span class="badge">2</span>1º Dia</a>
	<a><span class="badge">3</span>2º Dia</a>
	<a><span class="badge">4</span>3º Dia</a>
	<a class="current"><span class="badge badge-inverse">5</span>Confirmação</a>
</div>

<div>
<h3>Confirmação da Inscrição</h3>
{{ Form::open('cadConcluir') }}
	<p>Boleto - </p>
<div class="well">
	<table class="table">
		<thead>
			<th>Descrição</th>
			<th>Valor</th>
		</thead>
		<tbody>
			<tr>
				<td>Taxa Inscrição</td>
				<td>X</td>
			</tr>
			@foreach ($minicursos as $user)
			<tr>
				<td>{{$user}}</td>
				<td>$user</td>
			</tr>
			@endforeach
			<tr>
				<td>Total</td>
				<td>{{ $total }}</td>
			</tr>
		</tbody>
	</table>
</div>

<p>Imprima Horário</p>

						<table>
							<tr>
								<th>Horário</th>
								<th>Segunda - 16/04</th>
								<th>Terça - 17/04</th>
								<th>Quarta - 18/04</th>
							</tr>
							<tr>
								<td>09:00</td>
								<td>{{ Input::get('opSeg9') }}</td>
								<td>&nbsp;</td>
								<td>{{ Input::get("2012-04-1809:00") }}</td>
							</tr>
							<tr>
								<td>10:30</td>
								<td>{{ Input::get('opSeg10') }}</td>
								<td>{{ Input::get('opTer10') }}</td>
								<td>{{ Input::get('2012-04-1810:30') }}</td>
							</tr>
							<tr>
								<td>14:00</td>
								<td>{{ Input::get('opSeg14') }}</td>
								<td>{{ Input::get('opTer14') }}</td>
								<td>{{ Input::get('2012-04-1814:00') }}</td>
							</tr>
							<tr>
								<td>16:00</td>
								<td>{{ Input::get('opSeg16') }}</td>
								<td>{{ Input::get('opTer16') }}</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>18:30</td>
								<td>{{ Input::get('opSeg18') }}</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>19:00</td>
								<td>{{ Input::get('opSeg19') }}</td>
								<td>{{ Input::get('opTer19') }}</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>20:30</td>
								<td>{{ Input::get('opSeg20') }}</td>
								<td>{{ Input::get('opTer20') }}</td>
								<td>&nbsp;</td>
							</tr>
						</table>

<p>
	{{ Form::submit('Concluir', array('class' => 'btn btn-larg')) }}
	{{ HTML::link('#', 'Anular', array('class' => 'btn btn-larg', 'id' => 'bAnular')); }}
</p>

</div>

{{ Form::hidden('opSeg9', Input::get('opSeg9')) }}
{{ Form::hidden('opSeg10', Input::get('opSeg10')) }}
{{ Form::hidden('opSeg14', Input::get('opSeg14')) }}
{{ Form::hidden('opSeg16', Input::get('opSeg16')) }}
{{ Form::hidden('opSeg18', Input::get('opSeg18')) }}
{{ Form::hidden('opSeg19', Input::get('opSeg19')) }}
{{ Form::hidden('opSeg20', Input::get('opSeg20')) }}
{{ Form::hidden('opTer10', Input::get('opTer10')) }}
{{ Form::hidden('opTer14', Input::get('opTer14')) }}
{{ Form::hidden('opTer16', Input::get('opTer16')) }}
{{ Form::hidden('opTer19', Input::get('opTer19')) }}
{{ Form::hidden('opTer20', Input::get('opTer20')) }}
{{ Form::hidden('opQua9', Input::get('2012-04-1809:00')) }}
{{ Form::hidden('opQua10', Input::get('2012-04-1810:30')) }}
{{ Form::hidden('opQua14', Input::get('2012-04-1814:00')) }}
{{ Form::close() }}

    <div id="mAnular" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-body">
            <h3>Você tem certeza que deseja anular sua inscrição?</h3>
            {{ HTML::link('/', 'Sim', array('class' => 'btn btn-large btn-primary')); }}
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
});
</script>
@endsection