@layout('template.rh')

@section('title')
- Gerar Lista de Presença
@endsection

@section('content')
{{ Form::open('gerarListaPresenca', '', array('id' => 'gerarlista')) }}
   	<p>{{ Form::select('palestras', array('' => 'Selecione..') + $palestras, null, array('id' => 'palestras')) }}</p>
   	<p>{{ Form::submit('Gerar Lista de Presença', array('class' => 'btn btn-large btn btn-success')); }}</p>
{{ Form::close() }}
	<div id="result" class="hide"></div>
	<div id="carregando" class="hide"></div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#menu>li').removeClass('active');
    $("#1D").toggleClass('active');

    $('#gerarlista').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action'),
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
    });
});
</script>
@endsection