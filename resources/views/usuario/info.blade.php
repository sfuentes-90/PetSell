@extends('layouts.app')

@section('title', 'Informacion de Usuario')

@section('style')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')
  <div class="container">
  	<div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6 well profile">
      <div class="col-sm-12">
        <div class="col-xs-12 col-sm-8">
          <h2>{{ $info->name }}</h2>
          <p><strong>Rut: </strong>{{ $info->rut }}</p>
          <p><strong>Telefono: </strong>{{ $info->telefono }}</p>
          <p><strong>Email: </strong>{{ $info->email }}</p>
          <p><strong>N° Cuenta: </strong>{{ $info->cuenta }}</p>
          <p><strong>Banco: </strong>{{ $info->banco }}</p>
          <p><strong>Estado Premium: </strong>
              @if( $info->expiracion_premium <= Carbon\Carbon::today() )
                  Inactivo <a href="{{ url('user/planes') }}">comprar un plan.</a>
              @else
                  Activo hasta {{ \Carbon\Carbon::parse($info->expiracion_premium)->format('d/m/Y') }}
              @endif
          </p>
          <p><strong>Usuario desde: </strong>{{ \Carbon\Carbon::parse($info->created_at)->format('d/m/Y') }}</p>
        </div>
      </div>
      <div class="col-xs-12 text-center divider center-block">
        <div class="col-xs-12 col-sm-4 emphasis">
          <h2><strong> {{ $info->valoraciones_positivas }} </strong></h2>
          <p><small>Valoraciones Positivas</small></p>
          <button class="btn btn-success btn-block"><span class="glyphicon glyphicon-thumbs-up"></span></button>
        </div>
        <div class="col-xs-12 col-sm-4 emphasis">
          <h2><strong> {{ $info->valoraciones_negativas }} </strong></h2>
          <p><small>Valoraciones Negativas</small></p>
          <button class="btn btn-danger btn-block"><span class="glyphicon glyphicon-thumbs-down"></span></button>
        </div>
        <div class="col-xs-12 col-sm-4 emphasis">
          <h2><strong>0</strong></h2>
          <p><small>Total Ventas</small></p>
          <button class="btn btn-primary btn-block" onclick="location.href='{{ url('user/editar_usuario') }}';"><span class="fa fa-gear"></span></button>
        </div>
      </div>
  	</div>
  </div>
@endsection
