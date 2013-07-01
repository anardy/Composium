@layout('template.rh')

@section('title')
- Efetuar Pagamento
@endsection

@section('otherscss')
<style type="text/css">
form {
    margin: 0;
    padding: 0;
}
</style>
@endsection

@section('conteudo')
    @if ($cu)
    <div class="alert alert-success">  
        Pagamento realizado com Sucesso!
    </div>
    @endif
<div class="span6 offset3">
    {{ Form::open('pagamento', '', array('class' => 'form-inline')) }}
        {{ Form::text('cpf', '', array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-xlarge')) }}
        {{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
<?php Session::forget('cu');?>
<div class="span11">
    <table class="table">
        <thead>
            <th>Nome</th>
            <th>Data Inscrição</th>
            <th>Status</th>
            <th>Valor</th>
            <th>&nbsp;</th>
        </thead>
        <tbody>
            @foreach ($registros->results as $r)
                    <tr>
                        <td>{{ $r->cpf }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($r->data)) }}</td>
                        <td>
                            @if ($r->status == 0)
                                <span class="label label-important">Pagamento em aberto</span></td>
                            @else
                                <span class="label label-success">Pagamento Confirmado</span></td>
                            @endif
                        <td>R$ {{ $r->valor }}</td>
                        <td>
                            @if ($r->status == 0)
                                {{ Form::open('estoutestando', $r->cpf) }}
                                    {{ Form::hidden('cpf', $r->cpf) }}
                                    {{Form::submit('Confirma Pagamento', array('class' => 'btn btn-success')) }}
                                {{ Form::close() }}
                            @endif
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
    <?php echo $registros->links(); ?>
</div>
@endsection

@section('othersjs')
{{ HTML::script('js/jquery.masked.min.js'); }}
<script>
$("#cpf").inputmask("mask", {"mask": "999.999.999-99"});
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1B").toggleClass('active');
});
</script>
@endsection