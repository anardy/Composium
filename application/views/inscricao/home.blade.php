@layout('template.mainsemfooter')

@section('title')
- Inscrição
@endsection

@section('content')
<h2>Taxa de Inscrição</h2>
	<table class="table table-striped">
		<thead>
			<th>Categoria</th>
			<th>Até 13/Abril</th>
		</thead>
		<tbody>
			<tr>
				<td>Básico (Alunos da UNIFEI)</td>
				<td>R$ 5,00</td>
			</tr>
			<tr>
				<td>Básico (Participantes fora UNIFEI)</td>
				<td>R$ 30,00</td>
			</tr>
			<tr>
				<td>Cada Minicurso (Alunos dos cursos SI, CCO, ECO)</td>
				<td>R$ 10,00</td>
			</tr>
			<tr>
				<td>Cada Minicurso (Alunos outros cursos UNIFEI)</td>
				<td>R$ 20,00</td>
			</tr>
			<tr>
				<td>Cada Minicurso (Participantes fora UNIFEI)</td>
				<td>R$ 30,00</td>
			</tr>
		</tbody>
	</table>
<p><span class="label label-important">Atenção</span> Para minicursos de dois dias, será cobrado o valor referente a dois minicursos.</p>
<p><span class="label label-info">Importante</span> Palestras estão inclusas na taxa de inscrição.</p>
<p>&nbsp;</p>
@if (Auth::user())
	@if ($userinscrito < 1)
		<p>{{ HTML::link('iniciarinscricao', 'Iniciar Inscrição &raquo;', array('class' => 'btn btn-large btn btn-success')); }}</p>
	@else
		<p>A inscrição já foi feita. Se não está contente com a sua inscrição, solicite uma <a href="#">nova inscrição</a>.
	@endif
@endif

@endsection