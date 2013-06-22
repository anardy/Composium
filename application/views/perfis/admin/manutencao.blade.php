@layout('template.administrador')

@section('title')
- Administrador Manutenção
@endsection

@section('conteudo')
<div class="box span6">
    <div class="box-header">
        <h2><i class="icon-signal"></i><span class="break"></span>Páginas em Manutenção</h2>
        <div class="box-icon">
            <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="icon-remove"></i></a>
        </div>
    </div>
    <div class="sparkLineStats">
        <div class="box-content">
    <label class="checkbox">
        Encerrar Inscrições
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
    <label class="checkbox">
        Encerrrar Submissão de Artigos
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>

    <label class="checkbox">
        Página Inscrições em Manutentação
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
    <label class="checkbox">
        Página Minha Área em Manutenção
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
    <label class="checkbox">
        Formulário Submissão de Artigos em Manutenção
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>

    <p>{{ HTML::link('cadAdmin', 'Atualizar', array('class' => 'btn btn-large btn btn-success')); }}</p>
        </div>

</div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1G").toggleClass('active');
});
</script>
@endsection