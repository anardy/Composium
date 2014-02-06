@layout('template.administrador')

@section('title')
- Administrador Manutenção
@endsection

@section('conteudo')
<div class="span12">
    <h3>Manutenção</h3>
    <div class="row-fluid">
    {{ Form::open(action('administrador@manutencao')) }}
    <div class="box span6">
        <div class="box-header">
            <h2><i class="icon-signal"></i><span class="break"></span>Páginas em Manutenção</h2>
        </div>
        <div class="sparkLineStats">
            <div class="box-content">
                @foreach ($manutencao as $m)
                    <label class="checkbox">
                        {{$m->pagina}}
                        {{Form::checkbox('manutencao[]', $m->pagina, $m->status); }}
                    </label>
                @endforeach
            </div>
        </div>
    </div>

<div class="box span6">
    <div class="box-header">
        <h2><i class="icon-signal"></i><span class="break"></span>Desativar</h2>
    </div>
    <div class="sparkLineStats">
        <div class="box-content">
            @foreach ($desativar as $d)
                <label class="checkbox">
                    {{$d->pagina}}
                    {{Form::checkbox('desativar[]', $d->pagina, $d->status); }}
                </label>
            @endforeach
        </div>
    </div>
</div>

<div class="span12">
{{ Form::submit('Atualizar', array('class' => 'btn btn-large btn btn-success')); }}
</div>
{{ Form::close() }}
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