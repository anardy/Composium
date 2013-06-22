@layout('template.rh')

@section('title')
- Voluntários
@endsection

@section('otherscss')
@endsection


@section('conteudo')
    <h1>Voluntários</h1>
    <h4>Em construção...</h4>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#menu>li').removeClass('active');
    $("#1E").toggleClass('active');
});
</script>
@endsection