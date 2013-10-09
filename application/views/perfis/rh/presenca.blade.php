@layout('template.rh')

@section('title')
- Presença
@endsection

@section('conteudo')
<div class="span12">
<h3>Presença</h3>
{{ Form::open(action('rh@listapresenca'), '', array('class' => 'form-inline')) }}
   	{{ Form::select('palestras', array('' => 'Selecione..') + $palestras, null, array('id' => 'palestras', 'class' => 'span4')) }}
{{ Form::close() }}
    <hr>
	<div id="result"></div>
	<div id="carregando" class="hide"></div>
</div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#menu>li').removeClass('active');
    $("#1C").toggleClass('active');

    $('#palestras').change(function(e) {
        e.preventDefault();
        var action = 'listapresenca',
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