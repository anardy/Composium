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
	<a><span class="badge">3</span>2º Dia</a>
	<a class="current"><span class="badge badge-inverse">4</span>3º Dia</a>
    <a><span class="badge">5</span>Confirmação</a>
</div>

<div>
    <h3>18/04 - Quarta-Feira</h3>
    {{ Form::open('cadTerceirodia') }}
    <div class="span8">        
        {{ Form::submit('Finalizar', array('class' => 'btn btn-larg')) }}
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
                            	<td>{{ Form::radio($user->dia.$user->hora, str_replace(' ','',$user->abreviacao), false); }}</td>
	                            <td>{{ $user->hora }}</td>
	                            <td>{{ $user->abreviacao.' - '.$user->nome }}</td>
	                            <td>{{ $user->palestrante }}</td>
	                            <td>{{ $user->local }}</td>
                        	</tr>
                        @endforeach
                    </tbody>
                </table>
	<p>
		{{ Form::submit('Finalizar', array('class' => 'btn btn-larg')) }}
	</p>

{{ Form::hidden('opSeg9', Input::get('opSeg9')) }}
{{ Form::hidden('opSeg10', Input::get('opSeg10')) }}
{{ Form::hidden('opSeg14', Input::get('opSeg14')) }}
{{ Form::hidden('opSeg16', Input::get('opSeg16')) }}
{{ Form::hidden('opSeg18', Input::get('opSeg18')) }}
{{ Form::hidden('opSeg19', Input::get('opSeg19')) }}
{{ Form::hidden('opSeg20', Input::get('opSeg20')) }}
{{ Form::hidden('opTer10', Input::get('2012-04-1710:30')) }}
{{ Form::hidden('opTer14', Input::get('2012-04-1714:00')) }}
{{ Form::hidden('opTer16', Input::get('2012-04-1716:00')) }}
{{ Form::hidden('opTer19', Input::get('2012-04-1719:00')) }}
{{ Form::hidden('opTer20', Input::get('2012-04-1720:30')) }}
</div>
    {{ Form::close() }}
@endsection

@section('othersjs')
<script>
$(document).ready(function(){
    $("#desmarca").click(function() {
        $('input[type=radio]').prop('checked', false); // desmarca todos
    });
});
</script>
@endsection