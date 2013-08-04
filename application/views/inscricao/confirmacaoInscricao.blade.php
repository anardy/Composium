@layout('template.inscricoes')

@section('title')
- Inscrição
@endsection

@section('otherscss')
	{{ HTML::style('css/wizard.css') }}
@endsection

@section('content')
<h3>Detalhes da Inscrição</h3>
<div class="span6 wraper-r">
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
	{{ HTML::link('boleto', 'Imprimir Boleto', array('class' => 'btn btn-large btn-block btn-success')); }}
</div>
<div class="span5">
	<div class="alert alert-info">
            <i class="icon-lightbulb icon-2x pull-left"></i>
            <h5>Parabéns! Você Finalizou sua Inscrição.</h5>
            <ul class="unstyled">
                <ul>
                    <li>Para confirmar a sua presença pague o boleto em 3 dias</li>
                    <li>Após 3 dias a sua inscrição será deletada e você terá que refazer-lá</li>
                </ul>
            </ul>

            <span>Obrigado,<br>
            Equipe III Composium.</span>
    </div>
	{{ HTML::link('minharea', 'Minha Área', array('class' => 'btn btn-large btn-primary pull-right')); }}
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