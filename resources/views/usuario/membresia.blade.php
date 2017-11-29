@extends('layouts.app')

@section('title', 'Comprar Membresia')

@section('style')
<link rel="stylesheet" href="{{ asset('css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8"><h1>Compar Plan premium por {{ $data['cant_meses'] }} Meses</h1></div>
        <div class="col-md-8"><h2>${{ $data['precio'] }}</h2></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            {{ Form::open(array('route' => 'comprar_membresia','files' => true)) }}
            {{ Form::hidden('idMembresia', $data['id']) }}
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
                <div class="panel-heading"><span class="glyphicon glyphicon-info-sign"></span> Descripción</div>
                <div class="panel-body">
                    <p>{{ $data['descripcion'] }}</p>
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
