@extends('layouts.app')

@section('title', $data['aviso']->titulo)

@section('style')
<link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
@endsection


@section('content')
<div class="container">
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
            <div class="col-md-8"><h2><span>{{ $data['aviso']->titulo }}  &nbsp; ${{ $data['aviso']->precio }}</span></h2></div>
        </div>
        <!-- Descripcion -->
        <div class="row" style="margin-bottom:20px">
            <div class="col-md-2"></div>
            <div class="col-md-4" style="text-align: justify"><p>{!! $data['aviso']->descripcion !!}</p></div>
            <div class="col-md-4">
                <div class="datos-vendedor">
                  <table style="width: 100%">
                    <caption>Datos Vendedor</caption>
                    <tr>
                      <td>Nombre:</td><td>{{ $data['vendedor'][0]->name }}</td>
                    </tr>
                    <tr>
                      <td>Telefono:</td><td>{{ $data['vendedor'][0]->telefono}}</td>
                    </tr>
                    <tr>
                      <td>Correo:</td><td>{{ $data['vendedor'][0]->email }}</td>
                    </tr>
                    <tr>
                      <td>Banco:</td><td>{{ $data['vendedor'][0]->banco }}</td>
                    </tr>
                    <tr>
                      <td>N° Cuenta:</td><td>{{ $data['vendedor'][0]->cuenta }}</td>
                    </tr>
                    </table>
                </div>
                <div id="boton-comprar"><br>
                @auth('web')
                  @if ($data['aviso']['idUsuario'] !== Auth::id())
                    <a href='{{ url('user/vender', $data['aviso']->id) }}'><button type="button" class="btn btn-primary center-block" style="width: 180px">Comprar</button></a>
                  @endif
                @endauth
                </div>
                <br>
        </div>
    </div>
</div>
@endsection
@section('javascript1')
<script src="{{ asset('/js/gallery.js') }}"></script>
@endsection
@section('javascript2')
<script>
  $(document).ready(function() {
      $('.pgwSlider').pgwSlider({
        autoSlide: false,
        verticalCentering: true,
        displayControls:true,
        adaptiveHeight: true,
        maxHeight: 400,
        @if(count($data['fotos']) === 1)
        displayList:false
        @endif
      });
  });
</script>
@endsection
