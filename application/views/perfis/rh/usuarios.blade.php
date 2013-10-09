@layout('template.rh')

@section('title')
- Usuários
@endsection

@section('conteudo')
<div class="span12">
    <h3>Usuários</h3>
    <div class="row-fluid">
    <div class="span6 offset3">
        {{ Form::open(action('rh@usuarios'), '', array('class' => 'form-inline')) }}
            {{ Form::text('cpf', '', array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-xlarge')) }}
            {{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>

    <table class="table">
        <thead>
            <th>CPF</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Data Inscrição</th>
            <th>Curso</th>
            <th>Instituição</th>
        </thead>
        <tbody>
            @foreach ($registros->results as $r)
                    <tr>
                        <td><a href="conUsuario/{{$r->cpf}}">{{ $r->cpf }}</a></td>
                        <td>{{ $r->firstnome }} {{ $r->lastnome}}</td>
                        <td>{{ $r->email }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($r->data)) }}</td>
                        <td>{{ $r->curso }}</td>
                        <td>{{ $r->instituicao }}</td>
                    </tr>
            @endforeach
        </tbody>
    </table>
    <?php echo $registros->links(); ?>
</div>
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