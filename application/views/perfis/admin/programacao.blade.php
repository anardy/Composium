@layout('template.administrador')

@section('title')
- Usuários
@endsection

@section('otherscss')
{{ HTML::style('css/galery.css') }}
@endsection

@section('conteudo')
<div class="span12 main-content">
    <h3>Programação</h3>
    <div class="row-fluid">  
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">16 de Abril</a></li>
    <li><a href="#tab2" data-toggle="tab">17 de Abril</a></li>
    <li><a href="#tab3" data-toggle="tab">18 de Abril</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
                  <table class="table table-hover">
                <tbody>
                    @foreach ($primeiro as $user)
                        <tr>
                            <td>{{ date('H:i', strtotime($user->data)) }}</td>
                            <td style="width: 40%">{{ $user->nome }}</td>
                            <td>{{ $user->palestrante }}<br/><small>{{ $user->infopalestrante }}</small></td>
                            <td>{{ $user->local }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    <div class="tab-pane" id="tab2">
      <table class="table table-hover">
                <tbody>
                    @foreach ($segundo as $seg)
                        <tr>
                            <td>{{ date('H:i', strtotime($seg->data)) }}</td>
                            <td style="width: 40%">{{ $seg->nome }}</td>
                            <td>{{ $seg->palestrante }}<br/><small>{{ $seg->infopalestrante }}</small></td>
                            <td>{{ $seg->local }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
        <div class="tab-pane" id="tab3">
      <table class="table table-hover">
                <tbody>
                    @foreach ($terceiro as $ter)
                        <tr>
                            <td>{{ date('H:i', strtotime($ter->data)) }}</td>
                            <td>{{ $ter->nome }}</td>
                            <td>{{ $ter->palestrante }}<br/><small>{{ $ter->infopalestrante }}</small></td>
                            <td>{{ $ter->local }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
  </div>

</div>
</div>
@endsection

@section('othersjs')
<script>
$(document).ready(function(){        
    $('#dashboard-menu>li').removeClass('active');
    $("#1E").toggleClass('active');
});
</script>
@endsection