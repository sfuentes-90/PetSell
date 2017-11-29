<div class="row" style="margin-top:40px">
  <div class="col-md-2 col-md-offset-5">
    <span style="font-size: 40px" class="glyphicon glyphicon-star-empty">&nbsp;Destacados</span>
  </div>
</div>

<div class="col-md-12" style="margin-top:2px">
    <div class="well">
        <div id="destacados" class="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="row">
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[0]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[0]['id']) }}"><div class="titulo">{{ $data[0]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[1]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[1]['id']) }}"><div class="titulo">{{ $data[1]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[2]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[2]['id']) }}"><div class="titulo">{{ $data[2]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[3]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[3]['id']) }}"><div class="titulo">{{ $data[3]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[4]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[4]['id']) }}"><div class="titulo">{{ $data[4]['titulo'] }}</div></a>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[5]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[5]['id']) }}"><div class="titulo">{{ $data[5]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[6]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[6]['id']) }}"><div class="titulo">{{ $data[6]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[7]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[7]['id']) }}"><div class="titulo">{{ $data[7]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[8]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[8]['id']) }}"><div class="titulo">{{ $data[8]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[9]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[9]['id']) }}"><div class="titulo">{{ $data[9]['titulo'] }}</div></a>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[10]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[10]['id']) }}"><div class="titulo">{{ $data[10]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[11]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[11]['id']) }}"><div class="titulo">{{ $data[11]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[12]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[12]['id']) }}"><div class="titulo">{{ $data[12]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[13]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[13]['id']) }}"><div class="titulo">{{ $data[13]['titulo'] }}</div></a>
                      <a class="col-sm-3 carrusel-item" style="background-image: url({{ url("/")}}/{!! $data[14]['foto'][0]->filename or 'photos/default.png' !!})" href="{{ url('/avisos', $data[14]['id']) }}"><div class="titulo">{{ $data[14]['titulo'] }}</div></a>
                </div>
                </div>
            </div>
            <a class="left carousel-control" href="#destacados" data-slide="prev">‹</a>
            <a class="right carousel-control" href="#destacados" data-slide="next">›</a>
        </div>
    </div>
</div>
