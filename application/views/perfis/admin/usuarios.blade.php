@layout('template.administrador')

@section('title')
- Usuários
@endsection

@section('conteudo')
<div class="span6 offset3">
    {{ Form::open('adminusuarios', '', array('class' => 'form-inline')) }}
    <div class="input-append">
        {{ Form::text('cpf', '', array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-xlarge')) }}
            <div class="btn-group">
                {{ Form::submit('Buscar', array('class' => 'btn btn-primary', 'tabindex' => '-1')) }}
                <button class="btn dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </div>
            </div>
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
            <th>&nbsp;</th>
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
                        <td><a href="remUsuario/{{$r->cpf}}">Deletar</a></td>
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
    $("#1C").toggleClass('active');
});
</script>
@endsection