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
    <h3>17/04 - Terça-Feira</h3>
    {{ Form::open('cadSegundodia') }}
    {{ HTML::link('#', 'Desmarcar', array('class' => 'btn btn-larg', 'id' => 'desmarca')); }}
    <table class="table table-hover">
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                @if (($segunda14 == "MCI - PT1") && ($user->hora == "14:00"))
                                    @if ($user->abreviacao == "MCI - PT2")
                                        <td style="width: 1%">{{ Form::radio($user->data, str_replace(' ','',$user->abreviacao), true); }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                @elseif (($segunda14 == "MCIII - PT1") && ($user->hora == "14:00"))
                                    @if ($user->abreviacao == "MCIII - PT2")
                                        <td style="width: 1%">{{ Form::radio($user->data, str_replace(' ','',$user->abreviacao), true); }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                @elseif (($segunda14 == "MCIV - PT1") && ($user->hora == "19:00"))
                                    @if ($user->abreviacao == "MCIV - PT2")
                                        <td style="width: 1%">{{ Form::radio($user->data, str_replace(' ','',$user->abreviacao), true); }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                @elseif (($segunda14 != "MCI - PT1") || ($segunda14 != "MCIII - PT1") || ($segunda14 != "MCIV - PT1"))
                                    @if (($user->abreviacao == "MCI - PT2") || ($user->abreviacao == "MCIII - PT2") || ($user->abreviacao == "MCIV - PT2"))
                                        <td></td>
                                    @else
                                        @if ($user->vagas == 0)
                                            <td>Lotado</td>
                                        @else
                                            <td style="width: 1%">{{ Form::radio($user->data, $user->abreviacao, false); }}</td>
                                        @endif
                                    @endif
                                @else
                                    @if ($user->vagas == 0)
                                        <td>Lotado</td>
                                    @else
                                        <td style="width: 1%">{{ Form::radio($user->data, $user->codabreviacaoigo, false); }}</td>
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

{{ Form::hidden('opSeg9', Input::get('2012-04-16 09:00')) }}
{{ Form::hidden('opSeg10', Input::get('2012-04-16 10:30')) }}
{{ Form::hidden('opSeg14', Input::get('2012-04-16 14:00')) }}
{{ Form::hidden('opSeg16', Input::get('2012-04-16 16:00')) }}
{{ Form::hidden('opSeg18', Input::get('2012-04-16 18:30')) }}
{{ Form::hidden('opSeg19', Input::get('2012-04-16 19:00')) }}
{{ Form::hidden('opSeg20', Input::get('2012-04-16 20:30')) }}

</div>
    {{ Form::close() }}
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $('.wizard>a').removeClass('current');
    $('#span1A').removeClass('badge badge-inverse');
    $('#span1A').addClass('badge');

    $("#1B").toggleClass('current');
    $("#span1B").toggleClass('badge');
    $("#span1B").addClass('badge badge-inverse');

    $("input[type=radio]").click(function() {
        $('input[type=radio]').show()
        if ($(this).val() == 'MCVI') {
            $('input[type=radio][value=MCXI]').hide().prop('checked', false);
        } else if ($(this).val() == 'MCXI') {
            $('input[type=radio][value=MCVI]').hide().prop('checked', false);
        } else if ($(this).val() == 'MCVIII') {
            $('input[type=radio][value=MCXIII]').hide().prop('checked', false);
        } else if ($(this).val() == 'MCXIII') {
            $('input[type=radio][value=MCVIII]').hide().prop('checked', false);
        }
    });

    $("#desmarca").click(function() {
        var op = [];
        $('input[type=radio][value=MCXI]').show();
        $('input[type=radio][value=MCVI]').show();
        $('input[type=radio][value=MCXIII]').show();
        $('input[type=radio][value=MCVIII]').show();
        if ($('input[type=radio][value=MCI-PT2]').prop('checked') == true) {
            op.push('MCI-PT2');
        } else if ($('input[type=radio][value=MCIII-PT2]').prop('checked') == true) {
            op.push('MCIII-PT2');
        }
        if ($('input[type=radio][value=MCIV-PT2]').prop('checked') == true) {
            op.push('MCIV-PT2');
        }
        $('input[type=radio]').prop('checked', false); // desmarca todos
        $.each(op, function(i, val) {
            $('input[type=radio][value=' + val + ']').prop('checked', true);
        });
    });
});
</script>
@endsection