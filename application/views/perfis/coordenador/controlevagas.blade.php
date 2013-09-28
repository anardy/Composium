<ul class="audience-alt">
  @foreach ($vagas as $v)
  <li>
    <div class="value">{{$v->vagas}}</div>
    @if (is_null($texto))
      <div class="stat-name">Vagas Restantes ({{$v->abreviacao}} - {{$v->nome}})</div>
    @else
      <div class="stat-name">{{$texto}}</div>
    @endif
    <div class="percent">(+30%)</div>
    <div class="progress-bar audience-progress">
      <div class="progress progress-medium-blue">
        <div class="bar" style="width: 30%"></div>
      </div>
    </div>
  </li>
  @endforeach
</ul>