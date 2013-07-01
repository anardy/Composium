@layout('template.inscricoes')

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
<div class="span12">
    <h3>18/04 - Quarta-Feira</h3>
    {{ Form::open('cadTerceirodia') }}
    {{ HTML::link('#', 'Desmarcar', array('class' => 'btn btn-larg', 'id' => 'desmarca')); }}
    <table class="table table-hover">
        <tbody>
        @foreach ($users as $user)
            <tr>
                @if ($user->vagas == 0)
                    <td>Lotado</td>
                @else
                    <td style="width: 1%">{{ Form::radio($user->data, $user->abreviacao, false); }}</td>
                @endif
                <td style="width: 5%">{{ date('H:i', strtotime($user->data)) }}</td>
                <td style="width: 30%">{{ $user->nome }}</td>
                <td style="width: 25%">{{ $user->palestrante }}<br/><small>{{ $user->infopalestrante }}</small></td>
                @if ($user->abreviacao[0] == 'M')
                    <td style="width: 20%">{{ $user->ementa }} <strong>Pré-requisito</strong>: {{ $user->pre_requisito }}</td>
                @else
                    <td>{{ $user->ementa }}</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
	<p>
		{{ Form::submit('Finalizar', array('class' => 'btn btn-large btn btn-success')) }}
	</p>

{{ Form::hidden('opSeg9', Input::get('opSeg9')) }}
{{ Form::hidden('opSeg10', Input::get('opSeg10')) }}
{{ Form::hidden('opSeg14', Input::get('opSeg14')) }}
{{ Form::hidden('opSeg16', Input::get('opSeg16')) }}
{{ Form::hidden('opSeg18', Input::get('opSeg18')) }}
{{ Form::hidden('opSeg19', Input::get('opSeg19')) }}
{{ Form::hidden('opSeg20', Input::get('opSeg20')) }}
{{ Form::hidden('opTer10', Input::get('2012-04-17 10:30')) }}
{{ Form::hidden('opTer14', Input::get('2012-04-17 14:00')) }}
{{ Form::hidden('opTer16', Input::get('2012-04-17 16:00')) }}
{{ Form::hidden('opTer19', Input::get('2012-04-17 19:00')) }}
{{ Form::hidden('opTer20', Input::get('2012-04-17 20:30')) }}
</div>
    {{ Form::close() }}
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('.wizard>a').removeClass('current');
    $('#span1B').removeClass('badge badge-inverse');
    $('#span1B').addClass('badge');

    $("#1C").toggleClass('current');
    $("#span1C").toggleClass('badge');
    $("#span1C").addClass('badge badge-inverse');

    $("#desmarca").click(function() {
        $('input[type=radio]').prop('checked', false); // desmarca todos
    });
});
</script>
@endsection