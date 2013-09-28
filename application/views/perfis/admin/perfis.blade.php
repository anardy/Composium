@layout('template.administrador')

@section('title')
- Perfis
@endsection

@section('conteudo')
<div class="span12">
    <h3>Perfis</h3>
    <div class="row-fluid">  
<div class="span6 offset3">
    {{ Form::open(action('administrador@perfis'), '', array('class' => 'form-inline')) }}
		{{ Form::text('cpf', '', array('placeholder' => 'CPF', 'id' => 'cpf', 'class' => 'input-xlarge')) }}
		{{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>

<div class="span11">
    <!--<a href="{{ URL::to_route('CadPerfil') }}" class="btn btn-primary pull-right"> + Novo Perfil</a>-->
    <a href="#ModalCadPerfil" id="CadPerfil" role="button" class="btn btn-primary pull-right" data-toggle="modal">+ Novo Perfil</a>
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
                        <td><a href="#myModal" role="button" class="tnc" data-toggle="modal" data-id="{{$r->cpf}}" data-name="{{$r->perfil}}">{{ $r->cpf }}</a></td>
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

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Alterar Perfil</h3>
  </div>
  <div class="modal-body">
    <div id="bookId"></div>
</div>
</div>

<!-- Modal Cadastro de Novo Perfil -->
<div id="ModalCadPerfil" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Cadastrar Perfil</h3>
  </div>
  <div class="modal-body">
    <div id="testee"></div>
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
    $("#1B").toggleClass('active');
    
    $(document).on("click", ".tnc", function() {
        var myBookId = $(this).data('id');
        var second = $(this).data('name');
        $('#myModal').modal('show');
        $.ajax({
            type: 'GET',
            url: BASE+'/administrador/AltPerfil/'+myBookId+"/"+second,
            beforeSend: function() {
                $('#bookId').html('Carregando...');
            },
            success: function(data) {
                $('#bookId').html(data);
            }
        });
    });

    $(document).on("click", "#CadPerfil", function() {
        $('#ModalCadPerfil').modal('show');
        $.ajax({
            type: 'GET',
            url: BASE+'/administrador/CadPerfil/',
            beforeSend: function() {
                $('#testee').html('Carregando...');
            },
            success: function(data) {
                $('#testee').html(data);
            }
        });
    });
});
</script>
@endsection