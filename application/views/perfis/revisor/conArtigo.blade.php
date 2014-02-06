<p>Título: {{$results[0]->titulo}}</p>
<p>Autores: {{$results[0]->autores}}</p>
<p>Resumo: {{$results[0]->resumo}}</p>
<p>Palavras Chave: {{$results[0]->palavrachave}}</p>
<p>Status:
@if ($results[0]->status == 0)
	<span class="label label-info">PENDENTE</span>
@elseif ($results[0]->status == 1)
	<span class="label label-success">APROVADO</span>
@else
	<span class="label label-important">REPROVADO</span>
@endif
</p>
<p>Revisado por: {{$results[0]->firstnome}} {{$results[0]->lastnome}}