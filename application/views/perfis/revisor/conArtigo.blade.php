@layout('template.revisor')

@section('title')
- Consulta Artigo
@endsection

@section('conteudo')
   <h4>Dados do Artigo</h4>
    <p>Título: {{$results[0]->titulo}}</p>
    <p>Autores: {{$results[0]->autores}}</p>
    <p>Resumo: {{$results[0]->resumo}}</p>
    <p>Palavras Chave: {{$results[0]->palavrachave}}</p>
    Aprovado, QUem revisou, Rating, Feedback, Código Stand
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1A").toggleClass('active');
});
</script>
@endsection