@layout('template.voluntario')

@section('title')
- Voluntário
@endsection

@section('otherscss')
@endsection

@section('conteudo')
    <h1>Voluntário</h1>
    <h4>Escala de trabalho</h4>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1A").toggleClass('active');
});
</script>
@endsection