@layout('template.rh')

@section('title')
- Fora da Lista
@endsection

@section('otherscss')
@endsection


@section('content')
<div class="well hide"></div>
<div id="carregando" class="hide"></div>
{{ Form::open('insUserPalestra', '', array('id' => 'insuserpalestra')) }}
	<p>{{ Form::text('cpf', null, array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-medium')) }}</p>
   	<p>{{ Form::select('palestras', array('' => 'Selecione..') + $palestras, null, array('id' => 'palestras')) }}</p>
   	<p>{{ Form::submit('Inserir', array('class' => 'btn btn-large btn btn-success')); }}</p>
{{ Form::close() }}
@endsection

@section('othersjs')
{{ HTML::script('js/jquery.masked.min.js'); }}
<script>
$("#cpf").inputmask("mask", {"mask": "999.999.999-99"});

$(document).ready(function(){

    $('#menu>li').removeClass('active');
    $("#1C").toggleClass('active');

    $('#insuserpalestra').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action'),
            form_data = {
                cpf: $('#cpf').val(),
                abreviacao: $('#palestras').val()
            };
        $.ajax({
            type: 'POST',
            url: action,
            data: form_data,
            beforeSend: function() {
            	$('.well').hide();
                $('#carregando').html('Pesquisando...').show();
            },
            success: function(response) {
                $('#carregando').hide();
                $('.well').html(response).show();
            }
        });
    });
});
</script>
@endsection