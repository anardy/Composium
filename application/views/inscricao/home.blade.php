@layout('template.main')

@section('title')
- Inscrição
@endsection

@section('content')
<div class="span8">
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
	<p>{{ HTML::link('inicioinscricao', 'Iniciar Inscrição &raquo;', array('class' => 'btn btn-primary btn-large')); }}</p>
</div>

<div class="span4">
	Teste
</div>
@endsection