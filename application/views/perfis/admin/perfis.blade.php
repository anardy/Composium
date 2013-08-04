@layout('template.administrador')

@section('title')
- Perfis
@endsection

@section('conteudo')
<div class="span6 offset3">
    {{ Form::open('perfis', '', array('class' => 'form-inline')) }}
		{{ Form::text('cpf', '', array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-xlarge')) }}
		{{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>

<div class="span11">
    {{ HTML::link('cadPerfil', '+ Novo Perfil', array('class' => 'btn btn-primary pull-right')); }}
    <table class="table">
        <thead>
            <th>CPF</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>&nbsp;</th>
        </thead>
        <tbody>
            @foreach ($registros->results as $r)
                    <tr>
                        <td><a href="altPerfil/{{$r->cpf}}/{{$r->perfil}}">{{ $r->cpf }}</a></td>
                        <td>
                            <span style='display: block;'>{{ $r->firstnome }} {{ $r->lastnome}}</span>
                            <span class="subtext">{{ $r->perfil }}</span>
                        </td>
                        <td>{{ $r->email }}</td>
                        <td>
                            <a href='remPerfil/{{$r->cpf}}/{{$r->perfil}}'>Deletar</a>
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