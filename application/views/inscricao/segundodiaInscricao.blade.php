@layout('template.main')

@section('title')
- Inscrição
@endsection

@section('otherscss')
{{ HTML::style('css/wizard.css') }}
@endsection

@section('content')
<div class="wizard">
	<a><span class="badge">1</span>Dados Pessoais</a>
	<a><span class="badge">2</span>1º Dia</a>
	<a class="current"><span class="badge badge-inverse">3</span>2º Dia</a>
	<a><span class="badge">4</span>3º Dia</a>
    <a><span class="badge">5</span>Confirmação</a>
</div>

<div>
    <h3>17/04 - Terça-Feira</h3>
    {{ Form::open('cadSegundodia') }}
    <div class="span8">        
		{{ Form::submit('Próximo &raquo;', array('class' => 'btn btn-larg')) }}

	</div>
    <div class="span4">
        {{ HTML::link('#', 'Desmarcar Tudo', array('class' => 'btn btn-larg', 'id' => 'desmarca')); }}
    </div>
                <table class="table table-striped">
                    <thead>
                    	<th></th>
                        <th>Horário</th>
                        <th>Título</th>
                        <th>Palestrante / Ministrante</th>
                        <th>Local</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                @if (($segunda14 == "MCI - PT1") && ($user->hora == "14:00"))
                                    @if ($user->abreviacao == "MCI - PT2")
                                        <td>{{ Form::radio($user->dia.$user->hora, str_replace(' ','',$user->abreviacao), true); }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                @elseif (($segunda14 == "MCIII - PT1") && ($user->hora == "14:00"))
                                    @if ($user->abreviacao == "MCIII - PT2")
                                        <td>{{ Form::radio($user->dia.$user->hora, str_replace(' ','',$user->abreviacao), true); }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                @elseif (($segunda14 == "MCIV - PT1") && ($user->hora == "19:00"))
                                    @if ($user->abreviacao == "MCIV - PT2")
                                        <td>{{ Form::radio($user->dia.$user->hora, str_replace(' ','',$user->abreviacao), true); }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                @elseif (($segunda14 != "MCI - PT1") || ($segunda14 != "MCIII - PT1") || ($segunda14 != "MCIV - PT1"))
                                    @if (($user->abreviacao == "MCI - PT2") || ($user->abreviacao == "MCIII - PT2") || ($user->abreviacao == "MCIV - PT2"))
                                        <td></td>
                                @else
                                        <td>{{ Form::radio($user->dia.$user->hora, $user->abreviacao, false); }}</td>
                                    @endif
                                @else
                                    <td>{{ Form::radio($user->dia.$user->hora, $user->codabreviacaoigo, false); }}</td>
                                @endif
	                            <td>{{ $user->hora }}</td>
	                            <td>{{ $user->abreviacao.' - '.$user->nome }}</td>
	                            <td>{{ $user->palestrante }}</td>
	                            <td>{{ $user->local }}</td>
                        	</tr>
                        @endforeach
                    </tbody>
                </table>
	<p>
		{{ Form::submit('Próximo &raquo;', array('class' => 'btn btn-larg')) }}
	</p>

{{ Form::hidden('opSeg9', Input::get('2012-04-1609:00')) }}
{{ Form::hidden('opSeg10', Input::get('2012-04-1610:30')) }}
{{ Form::hidden('opSeg14', Input::get('2012-04-1614:00')) }}
{{ Form::hidden('opSeg16', Input::get('2012-04-1616:00')) }}
{{ Form::hidden('opSeg18', Input::get('2012-04-1618:30')) }}
{{ Form::hidden('opSeg19', Input::get('2012-04-1619:00')) }}
{{ Form::hidden('opSeg20', Input::get('2012-04-1620:30')) }}

</div>
    {{ Form::close() }}
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
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