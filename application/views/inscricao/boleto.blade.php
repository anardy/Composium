@layout('template.mainsemfooter')
@section('otherscss')
<style type="text/css">
.cu {
  width: 100%;
  margin-bottom: 20px;
}

.cu th,
.cu td {
  padding: 8px;
  line-height: 20px;
  text-align: left;
  vertical-align: top;
  border: 1px solid #dddddd;
}
</style>
@endsection

Instrução para Impressão
<ul>
<li>Utilize folha A4 (210 x 297 mm) ou Carta (216 x 279 mm) e margens mínimas à esquerda e à direita do formulário.</li>
<li>A primeira parte deve ficar com a organização do evento!</li>
<li>A segunda parte é o comprovante do participante.</li>
</ul>
@section('content')
<div class="span10">
  <table class="cu">
  <tr>
    <td colspan="3">{{ HTML::image('img/logoboleto.png', '', array('class' => 'pull-left')); }}</td>
    <td VALIGN=TOP align="right">Vencimento<br>03/07/2013</td>
  </tr>
  <tr>
    <td>Nome: {{ $result[0]->firstnome . " " . $result[0]->lastnome }}</td>
    <td colspan="2">Data Documento<br>{{date("d/m/Y")}}</td>
    <td VALIGN=TOP align="right">Valor<br>R$ {{$total}}</td>
  </tr>
  <tr>
    <td VALIGN=TOP colspan="4">
      Instruções
      <p>Pagamento deve ser realizado no Centro de ComVivência da Universidade Federal de Itajubá (UNIFEI)</p>
      <p>Horários:</p>
      <p>Segunda a Sexta das 12:00 às 13:00, 15:20 às 15:45, 18:00 às 19:00 e das 20:30 às 21:00</p>
    </td>
  </tr>
</table>
  <small>Destaque aqui</small>
  <hr style="margin:0;border: 1px dashed #000000;">
  <br>
<table class="cu">
  <tr>
    <td colspan="3">{{ HTML::image('img/logoboleto.png', '', array('class' => 'pull-left')); }}</td>
    <td VALIGN=TOP align="right">Vencimento<br>03/07/2013</td>
  </tr>
  <tr>
    <td>Nome: {{ $result[0]->firstnome . " " . $result[0]->lastnome }}</td>
    <td colspan="2">Data Documento<br>{{date("d/m/Y")}}</td>
    <td VALIGN=TOP align="right">Valor<br>R$ {{$total}}</td>
  </tr>
  <tr>
    <td VALIGN=TOP colspan="4">
      <p>&nbsp;</p><p>&nbsp;IMAGEMMM DE CARIMBO NO FUNDO</p>
    </td>
  </tr>
</table>
</div>
@endsection