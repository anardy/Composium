@layout('template.administrador')

@section('title')
- Usuários
@endsection

@section('conteudo')
<div class="span12">
    <h3>Usuários Cadastrados</h3>
    <div class="row-fluid">
<div class="span6 offset3">
    {{ Form::open('administrador/usuarios', '', array('class' => 'form-inline')) }}
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
            <th>&nbsp;</th>
        </thead>
        <tbody>
            @foreach ($registros->results as $r)
                    <tr>
                        <td><a href="#myModal" role="button" class="tnc" data-toggle="modal" data-id="{{$r->cpf}}">{{ $r->cpf }}</a></td>
                        <td>{{ $r->firstnome }} {{ $r->lastnome}}</td>
                        <td>{{ $r->email }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($r->data)) }}</td>
                        <td><a href="remUsuario/{{$r->cpf}}">Deletar</a></td>
                    </tr>
            @endforeach
        </tbody>
    </table>
    <?php echo $registros->links(); ?>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Visão Detalhada</h3>
  </div>
  <div class="modal-body">
    <div id="bookId"/>
  </div>
</div>

</div>
</div>
@endsection

@section('othersjs')
{{ HTML::script('js/jquery.masked.min.js'); }}
<script>
$("#cpf").inputmask("mask", {"mask": "999.999.999-99"});

$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1C").toggleClass('active');
    
    $(document).on("click", ".tnc", function () {
        var myBookId = $(this).data('id');
        //$(".modal-body #bookId").html( myBookId );
        $('#myModal').modal('show');
        $.ajax({
            type: 'GET',
            url: BASE+'/administrador/ConUsuario/'+myBookId,
            beforeSend: function() {
                $('#bookId').html('Carregando...');
            },
            success: function(data) {
                $('#bookId').html(data);
            }
        });
    });
});
</script>
@endsection