@layout('template.minharea')

@section('title')
- Submissão Artigo
@endsection

@section('conteudo')
@if ($msgm == 'enviado')
    <div class="alert alert-success">  
        Artigo enviado com Sucesso!
    </div>
@endif
<div class="span12 main-content">
    <h2>Submeter Artigo</h2>
    <p>As normas para artigo e painel estão disponível para <a href='NormasTrabalho.pdf'>download</a>.</p>
    {{ Form::open_for_files(action('minharea@artigo')) }}
        <p>{{ Form::text('titulo', Input::old('titulo'), array('placeholder' => 'Título', 'class' => 'input-xlarge')) }} {{ $errors->first('titulo', 'Preenche está merda') }}</p>
        <p>{{ Form::text('autores', Input::old('autores'), array('placeholder' => 'Autores', 'class' => 'input-xlarge')) }} {{ $errors->first('autores', 'Preenche está merda') }}</p>
        <p>{{ Form::textarea('resumo', Input::old('resumo'), array('placeholder' => 'Resumo', 'class' => 'input-xlarge')) }} {{ $errors->first('resumo', 'Preenche está merda') }}</p>
        <p>{{ Form::text('palavrachave', Input::old('palavrachave'), array('placeholder' => 'Palavras Chave', 'class' => 'input-xlarge')) }} {{ $errors->first('palavrachave', 'Preenche está merda') }}</p>
        <p>{{ Form::file('artigo', array('accept' => 'application/pdf')) }} {{ $errors->first('artigo', 'Sem gracinha') }}</p>
        <p>{{ Form::submit('Enviar Artigo', array('class' => 'btn btn-large btn btn-success')) }}</p>
    {{ Form::close() }}
</div>
@endsection
<?php Session::forget('artigo');?>

@section('othersjs')
<script>
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1B").toggleClass('active');
});
</script>
@endsection