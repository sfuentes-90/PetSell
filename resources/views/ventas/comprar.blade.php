@extends('layouts.app')

@section('title', 'Venta')

@section('style')
<link rel="stylesheet" href="{{ asset('css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6"><h1>{{ $data['aviso']->titulo }}</h1></div>
        <div class="col-md-4"><h1>Precio: {{ $data['aviso']->precio }}</h1></div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {{ Form::open(array('route' => 'vender.store','files' => true)) }}
            {{ Form::hidden('idVendedor', $data['usuario']->id) }}
            {{ Form::hidden('idAviso', $data['aviso']->id) }}
            <div class="form-group">
              <label for="direccion_envio" class="col-md-8 control-label">direccion de envio</label>
              <input id="direccion_envio" type="text" class="form-control" name="direccion_envio" value="{{ old('direccion_envio') }}" data-toggle="tooltip" data-placement="bottom" title="Puede agregar una direccion de envio si lo desea" autofocus>
            </div>
            <div class="form-group">
              <label for="comentarios" class="col-md-8 control-label">Comentarios</label>
              <input id="comentario" type="text" class="form-control" name="comentario" value="{{ old('comentario') }}" data-toggle="tooltip" data-placement="bottom" title="Envie un comentario al vendedor"autofocus>
            </div>
            <div class="form-group">
              <label for="comprobante" class="col-md-4 control-label">Comprobante</label>
              <input id="comprobante" type="file" class="form-control" name="comprobante" required>
            </div>
            <button type="submit" class="btn btn-success center-block" style="width: 180px">Comprar</button>
            {!! Form::close() !!}
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <div class="panel panel-primary class">
                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Información Vendedor</div>
                <div class="panel-body">
                    <ul>
                        <li>Nombre: {{ $data['usuario']->name }}</li>
                        <li>Cuenta N°: {{ $data['usuario']->cuenta }}</li>
                        <li>Banco: {{ $data['usuario']->banco }}</li>
                        <li>Tipo Cuenta: {{ $data['usuario']->tipo_cuenta }}</li>
                        <li>Telefono: {{ $data['usuario']->telefono }}</li>
                        <li>Correo: {{ $data['usuario']->email }}</li>
                        <li>Valoraciones: {{ $data['usuario']->valoraciones_positivas }}/{{ ($data['usuario']->valoraciones_negativas) +  ($data['usuario']->valoraciones_positivas) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">

        </div>
  </div>
</div>
@endsection

@section('javascript1')
<script src="{{ asset('js/fileinput.min.js') }}"></script>
<script src="{{ asset('js/locales/es.js') }}"></script>
<script src="{{ asset('js/theme.min.js') }}"></script>
@endsection

@section('javascript2')
<script>
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})

  $(document).ready(function() {
    $("#comprobante").fileinput({
      showUpload: false,
      theme: "explorer",
      language: 'es',
      allowedFileExtensions: ['jpg', 'png', 'pdf'],
      maxFileCount: 1,
      layoutTemplates: {
          main1: "{preview}\n" +
          "<div class=\'input-group {class}\'>\n" +
          "   <div class=\'input-group-btn\'>\n" +
          "       {browse}\n" +
          "       {upload}\n" +
          "       {remove}\n" +
          "   </div>\n" +
          "   {caption}\n" +
          "</div>"
      }
    });
  });
</script>
@endsection
