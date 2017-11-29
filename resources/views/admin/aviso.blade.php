@extends('layouts.preview')

@section('title', $data['aviso']->titulo)

@section('style')
<link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
@endsection


@section('content')
    <div class="row">
      <div class="col-md-8 center-block" style="float:none">
        <ul class="pgwSlider">
          @foreach ($data['fotos'] as $foto)
              <li><img src="{{ url('/').'/'.$foto->filename }}/"></li>
          @endforeach
        </ul>
      </div>
    </div>

    <div class="publicacion">
        <!-- Titulo y Precio -->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8"><h2><span>{{ $data['aviso']->titulo }} &nbsp; ${{ $data['aviso']->precio }}</span></h2></div>
        </div>
        <!-- Descripcion -->
        <div class="row" style="margin-bottom:20px">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="text-align: justify"><p>{!! $data['aviso']->descripcion !!}</p></div>
        </div>
    </div>
@endsection
@section('javascript1')
<script src="{{ asset('/js/gallery.js') }}"></script>
@endsection
@section('javascript2')
<script>
  $(document).ready(function() {
      $('.pgwSlider').pgwSlider({autoSlide: false, maxHeight: 350, verticalCentering: true, displayControls:true});
  });
</script>
@endsection
