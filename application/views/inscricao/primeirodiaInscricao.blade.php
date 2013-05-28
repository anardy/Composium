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
	<a class="current"><span class="badge badge-inverse">2</span>1º Dia</a>
	<a><span class="badge">3</span>2º Dia</a>
	<a><span class="badge">4</span>3º Dia</a>
    <a><span class="badge">5</span>Confirmação</a>
</div>

<div>
    <h3>16/04 - Segunda-Feira</h3>
    {{ Form::open('cadPrimeirodia') }}
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
                                <td>{{ Form::radio($user->dia.$user->hora, $user->abreviacao, false); }}</td>
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
    {{ Form::close() }}
</div>
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