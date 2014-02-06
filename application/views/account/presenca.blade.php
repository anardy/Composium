@layout('template.minharea')

@section('title')
- Presença
@endsection

@section('otherscss')
<style type="text/css">
#g1 {
    width:400px; height:320px;
    display: inline-block;
}
</style>
@endsection

@section('conteudo')
<div class="span12 main-content">
    <h2>Controle de Presença</h2>
    @if (!$controle_presenca)
        <h4>Nenhuma presença cadastrada</h4>
    @else
        <div class="span5">
            <table class="table table-hover">
                @foreach ($controle_presenca as $d)
                    <tr>
                        <td>{{ $d->abreviacao }} - {{ $d->nome }}</td>
                        @if ($d->presenca == 0)
                            <td><i class="icon-remove"></i></td>
                        @else
                            <td><i class="icon-ok"></i></td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="span4">
            <div id="g1"><script>gerar_graph()</script></div>
        </div>
    @endif
</div>
@endsection

@section('othersjs')
    {{ HTML::script('js/justgage.1.0.1.min'); }}
    {{ HTML::script('js/raphael.2.1.0.min.js'); }}
<script>
function gerar_graph() {
    var g = new JustGage({
        id: "g1", 
        value: {{$media_user}}, 
        min: 0,
        max: 100,
        title: 'Média',
        levelColorsGradient: false,
        levelColors: [
                "#ff0000",
                "#f9c802",
                "#a9d70b"
        ],
    });
}
$(document).ready(function(){
    $('#dashboard-menu>li').removeClass('active');
    $("#1C").toggleClass('active');
});
</script>
@endsection