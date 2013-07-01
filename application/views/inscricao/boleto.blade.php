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

@section('content')
Instrução para Impressão
<li>Utilize folha A4 (210 x 297 mm) ou Carta (216 x 279 mm) e margens mínimas à esquerda e à direita do formulário.<br>
<li>A primeira parte deve ficar com a organização do evento!
<li>A segunda parte é o comprovante do participante.
  <li>Dúvidas entre em contato composium@unifei.edu.br


<div class="span10">
  <table class="cu">
  <tr>
    <td colspan="3">Imagem Composium</td>
    <td VALIGN=TOP align="right">Vencimento<br>03/07/2013</td>
  </tr>
  <tr>
    <td>Nome: André Mack Nardy</td>
    <td colspan="2">Data Documento<br>27/06/2013</td>
    <td VALIGN=TOP align="right">Valor<br>R$ 25</td>
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
  <hr>
<table class="cu">
  <tr>
    <td colspan="3">Imagem Composium</td>
    <td VALIGN=TOP align="right">Vencimento<br>03/07/2013</td>
  </tr>
  <tr>
    <td>Nome: André Mack Nardy</td>
    <td colspan="2">Data Documento<br>27/06/2013</td>
    <td VALIGN=TOP align="right">Valor<br>R$ 25</td>
  </tr>
  <tr>
    <td VALIGN=TOP colspan="4">
      <p>&nbsp;</p><p>&nbsp;</p>
    </td>
  </tr>
</table>
</div>
@endsection