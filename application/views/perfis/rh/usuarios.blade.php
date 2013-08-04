@layout('template.rh')

@section('title')
- Usuários
@endsection

@section('conteudo')
<div class="span6 offset3">
    {{ Form::open('usuarios', '', array('class' => 'form-inline')) }}
        {{ Form::text('cpf', '', array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-xlarge')) }}
		{{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>

<div class="span11">
    <table class="table">
        <thead>
            <th>CPF</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Data Inscrição</th>
            <th>Status</th>
        </thead>
        <tbody>
            @foreach ($registros->results as $r)
                    <tr>
                        <td><a href="conUsuario/{{$r->cpf}}">{{ $r->cpf }}</a></td>
                        <td>{{ $r->firstnome }} {{ $r->lastnome}}</td>
                        <td>{{ $r->email }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($r->data)) }}</td>
                        <td>
                            @if ($r->status == 0)
                                <span class="label label-important">Pagamento em aberto</span>
                            @else
                                <span class="label label-success">Pagamento confirmado</span>
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
    $("#1F").toggleClass('active');
});
</script>
@endsection