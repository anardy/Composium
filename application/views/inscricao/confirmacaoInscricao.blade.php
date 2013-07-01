@layout('template.inscricoes')

@section('title')
- Inscrição
@endsection

@section('otherscss')
	{{ HTML::style('css/wizard.css') }}
@endsection

@section('content')
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
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('.wizard>a').removeClass('current');
    $('#span1C').removeClass('badge badge-inverse');
    $('#span1C').addClass('badge');

    $("#1D").toggleClass('current');
    $("#span1D").toggleClass('badge');
    $("#span1D").addClass('badge badge-inverse');
});
</script>
@endsection