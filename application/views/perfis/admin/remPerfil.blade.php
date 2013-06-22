@layout('template.admin')

@section('title')
- Remover Perfil
@endsection

@section('content')
<h4>Remover Perfil</h4>
	<div class="well hide"></div>
	<div id="carregando" class="hide"></div>
	{{ Form::open('remPerfil', '', array('id' => 'remperfil')) }}
		<p>{{ Form::text('cpf',null, array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-medium')) }}</p>
		<p>{{ Form::submit('Remover', array('class' => 'btn btn-large btn btn-danger')); }}</p>
	{{ Form::close() }}
@endsection

@section('othersjs')
{{ HTML::script('js/jquery.masked.min.js'); }}
<script>
$("#cpf").inputmask("mask", {"mask": "999.999.999-99"});
$(document).ready(function(){
    $('#remperfil').submit(function(e) {
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
                $("#cpf").inputmask("getemptymask");
            }
        });
    });
});
</script>
@endsection