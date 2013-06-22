@layout('template.admin')

@section('title')
- Alterar Perfil
@endsection

@section('content')
<h4>Alterar Perfil</h4>
	<div class="well hide"></div>
	<div id="carregando" class="hide"></div>
	{{ Form::open('altPerfil', '', array('id' => 'altperfil')) }}
		<p>{{ Form::text('cpf',null, array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-medium')) }}</p>
		<p>{{ Form::select('perfil', array('Administrador' => 'Administrador', 'Coordenador' => 'Coordenador', 'RH' => 'RH', 'Revisor' => 'Revisor', 'Voluntário' => 'Voluntário'), null, array('id' => 'perfil')) }}</p>
		<p>{{ Form::submit('Alterar', array('class' => 'btn btn-large btn btn-success')); }}</p>
	{{ Form::close() }}
@endsection

@section('othersjs')
{{ HTML::script('js/jquery.masked.min.js'); }}
<script>
$("#cpf").inputmask("mask", {"mask": "999.999.999-99"});
$(document).ready(function(){
    $('#altperfil').submit(function(e) {
        e.preventDefault();
        var action = $(this).attr('action'),
            form_data = {
                cpf: $('#cpf').val(),
                perfil: $('#perfil').val()
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