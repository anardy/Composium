@layout('template.minharea')

@section('title')
- Certificados
@endsection

@section('conteudo')
<div class="span8 main-content">
    <h2>Certificados</h2>
        <div class="alert alert-error">
            <h4>Os certificados ainda não estão diponíveis!!</h4>
        </div>
</div>
@endsection


@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1C").toggleClass('active');
});
</script>
@endsection