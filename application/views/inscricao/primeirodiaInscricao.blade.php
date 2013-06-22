@layout('template.mainsemfooter')

@section('title')
- Inscrição
@endsection

@section('otherscss')
    {{ HTML::style('css/wizard.css') }}
    <style type="text/css">
    #desmarca {
        margin-bottom: 10px;
    }
    </style>
@endsection

@section('content')
<div class="wizard">
	<a class="current"><span class="badge badge-inverse">1</span>1º Dia</a>
	<a><span class="badge">2</span>2º Dia</a>
	<a><span class="badge">3</span>3º Dia</a>
    <a><span class="badge">4</span>Confirmação</a>
</div>

    <h3>16/04 - Segunda-Feira</h3>
    {{ Form::open('cadPrimeirodia') }}
    
    {{ HTML::link('#', 'Desmarcar', array('class' => 'btn', 'id' => 'desmarca')); }}

    <table class="table table-hover">
        <tbody>
        @foreach ($users as $user)
            <tr>
                @if ($user->vagas == 0)
                    <td>Lotado</td>
                @else
                    @if ($user->abreviacao == 'CI')
                        <td style="width: 1%">{{ Form::radio($user->data, $user->abreviacao, true); }}</td>
                    @else
                        <td style="width: 1%">{{ Form::radio($user->data, $user->abreviacao, false); }}</td>
                    @endif
                @endif
	            <td style="width: 5%">{{ date('H:i', strtotime($user->data)) }}</td>
	            <td style="width: 30%">{{ $user->nome }}</td>
	            <td style="width: 19%">{{ $user->palestrante }}<br/><small>{{ $user->infopalestrante }}</small></td>
                @if ($user->abreviacao[0] == 'M')
                    <td style="width: 45%">{{ $user->ementa }} <strong>Pré-requisito</strong>: {{ $user->pre_requisito }}</td>
                @else
                    <td>{{ $user->ementa }}</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

	<p>
        {{ Form::submit('Próximo &raquo;', array('class' => 'btn btn-large btn btn-success')) }}
	</p>
    {{ Form::close() }}
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $("input[type=radio]").click(function() {
        $('input[type=radio]').show()
        if ($(this).val() == 'CI') {
            $('input[type=radio][value=CII]').hide().prop('checked', false);
        } else if ($(this).val() == 'CII') {
            $('input[type=radio][value=CI]').hide().prop('checked', false);
        }
    });
    $("#desmarca").click(function() {
        $('input[type=radio]').show().prop('checked', false); // desmarca todos
    });
});
</script>
@endsection