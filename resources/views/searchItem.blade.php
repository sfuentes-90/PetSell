<div class="item">
    <a href="{{ url('/avisos', $resultado->idAviso) }}" style="color: #484848;">
      <div class="col-md-4 search-image" style="background-image:url({{ url("/")}}/{!! $resultado->filename or 'photos/default.png' !!})"></div>
      <div class="col-md-8">
          <div class="row">
              <div class="col-md-4">{{ $resultado->titulo }}</div>
              <div class="col-md-4">$ {{ $resultado->precio }}</div>
          </div>
          <div class="row"><br><br></div>
      </div>
      <div class="row">
          <div class="col-md-8">{{ str_limit(strip_tags($resultado->descripcion), $limit = 300, $end = '...') }}</div>
      </div>
    </a>
</div>
<br><hr>
