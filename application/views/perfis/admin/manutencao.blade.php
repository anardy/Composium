@layout('template.administrador')

@section('title')
- Administrador Manutenção
@endsection

@section('conteudo')
<div class="span12">
    <h3>Manutenção</h3>
    <div class="row-fluid">
<div class="box span6">
    <div class="box-header">
        <h2><i class="icon-signal"></i><span class="break"></span>Páginas em Manutenção</h2>
    </div>
    <div class="sparkLineStats">
        <div class="box-content">
    <label class="checkbox">
        Página Principal
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
    <label class="checkbox">
        Página Inscrições
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
    <label class="checkbox">
        Página Minha Área
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
    <label class="checkbox">
        Formulário Submissão de Artigos
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
    <label class="checkbox">
        Página RH
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
    <label class="checkbox">
        Página Revisor
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
    <label class="checkbox">
        Página Coordenador
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
        </div>
</div>
</div>

<div class="box span6">
    <div class="box-header">
        <h2><i class="icon-signal"></i><span class="break"></span>Desativar</h2>
    </div>
    <div class="sparkLineStats">
        <div class="box-content">
    <label class="checkbox">
        Inscrições
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
    <label class="checkbox">
        Submissão de Artigos
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
    <label class="checkbox">
        Candidatura de Voluntário
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>

    <label class="checkbox">
        Solicitação de Reinscrição
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>

    <label class="checkbox">
        Notificações
        {{Form::checkbox('name', 'value', Input::had('name')); }}
    </label>
        </div>
</div>
</div>

<div class="span12">
{{ HTML::link('#', 'Atualizar', array('class' => 'btn btn-large btn btn-success')); }}
</div>
</div>
</div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1F").toggleClass('active');
});
</script>
@endsection