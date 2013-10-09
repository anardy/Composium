@layout('template.coordenador')

@section('title')
- Coordenador
@endsection

@section('conteudo')
<div class="span12">
    <h3>Vagas</h3>
    <div class="row-fluid">
        <div class="span6 offset3">
        {{ Form::open(action('coordenador@vagas', '', array('class' => 'form-inline', 'id' => 'form'))) }}
        {{ Form::select('palestras', array('all' => 'Selecione..') + $palestras, null, array('id' => 'palestras', 'class' => 'span8')) }}
        {{ Form::close() }}
        </div>


        <div class="span11">
            <hr>
            <div id="result"></div>
            <div id="carregando" class="hide"></div>
        </div>

    </div>
</div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1B").toggleClass('active');

    $('#palestras').change(function(e) {
        e.preventDefault();
        teste();
    });

    function teste() {
        var action = $('#form').attr('action'),
            form_data = {
                abreviacao: $('#palestras').val()
            };
        $.ajax({
            type: 'POST',
            url: action,
            data: form_data,
            beforeSend: function() {
                $('#result').hide();
                $('#carregando').html('Pesquisando...').show();
            },
            success: function(response) {
                $('#carregando').hide();
                $('#result').html(response).show();
            }
        });
    }
    teste();
});
</script>
@endsection