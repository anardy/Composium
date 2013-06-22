@layout('template.voluntario')

@section('title')
- Voluntário
@endsection

@section('otherscss')
@endsection

@section('area')
Coordenador
@endsection

@section('conteudo')
    <h1>Voluntário</h1>
    <h4>Em construção...</h4>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1A").toggleClass('active');
});
</script>
@endsection