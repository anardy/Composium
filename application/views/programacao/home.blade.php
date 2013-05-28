
<h3>{{ $dia }}</h3>
<table class="table table-striped">
    <thead>
        <th>Horário</th>
        <th>Título</th>
        <th>Palestrante / Ministrante</th>
        <th>Local</th>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->hora }}</td>
                <td>{{ $user->nome }}</td>
                <td>{{ $user->palestrante_ministrante }}</td>
                <td>{{ $user->local }}</td>
            </tr>
        @endforeach
    </tbody>
</table>