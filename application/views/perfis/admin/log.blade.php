@layout('template.admin')

@section('title')
- Logs
@endsection

@section('otherscss')
@endsection


@section('content')
    <h1>Visualização de Logs</h1>
    <h4>Em construção...</h4>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#menu>li').removeClass('active');
    $("#1B").toggleClass('active');
});
</script>
@endsection