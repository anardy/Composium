@layout('template.admin')

@section('title')
- Consultar Perfil
@endsection

@section('content')
	<h4>Consultar Perfil</h4>
	<div class="well hide"></div>
	<div id="carregando" class="hide"></div>
	{{ Form::open('conPerfil', '', array('id' => 'conperfil')) }}
		<p>{{ Form::text('cpf',null, array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-medium')) }}</p>
		<p>{{ Form::submit('Consultar', array('class' => 'btn btn-large btn btn-success')); }}</p>
	{{ Form::close() }}
@endsection

@section('othersjs')
{{ HTML::script('js/jquery.masked.min.js'); }}
<script>
$("#cpf").inputmask("mask", {"mask": "999.999.999-99"});
$(document).ready(function(){
    $('#conperfil').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action'),
            form_data = {
                cpf: $('#cpf').val()
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
                $('#cpf').val($('#cpf').inputmask('getemptymask'));

            }
        });
    });
});
</script>
@endsection