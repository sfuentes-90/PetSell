@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ url('/summernote/summernote.css') }}">
<link rel="stylesheet" href="{{ asset('css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
@endsection

@section('title', 'Editar Usuario')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Información</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('user/actualizar_info') }}">
                        {{ csrf_field() }}
                        <div class="form-group"><label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-8"><input id="email" type="email" class="form-control" name="email" value="{{ $info->email }}" autofocus></div>
                        </div>

                        <div class="form-group"><label for="telefono" class="col-md-4 control-label">Telefono</label>
                            <div class="col-md-8"><input id="telefono" type="text" class="form-control" name="telefono" value="{{ $info->telefono }}" autofocus></div>
                        </div>

                        <div class="form-group"><label for="banco" class="col-md-4 control-label">Banco</label>
                            <div class="col-md-8">
                                <select class="form-control" id="banco" name="banco">
                                  <option value="" disabled>Seleccione un banco</option>
                                  <option value="Banco De Chile"@if( $info->banco === 'Banco De Chile') selected @endif>Banco De Chile</option>
                                  <option value="Banco Estado"@if( $info->banco === 'Banco Estado') selected @endif>Banco Estado</option>
                                  <option value="Scotiabank"@if( $info->banco === 'Scotiabank') selected @endif>Scotiabank</option>
                                  <option value="BCI"@if( $info->banco === 'BCI') selected @endif>BCI</option>
                                  <option value="Banco Bice"@if( $info->banco === 'Banco Bice') selected @endif>Banco Bice</option>
                                  <option value="Banco Santander"@if( $info->banco === 'Banco Santander') selected @endif>Banco Santander</option>
                                  <option value="Itaú"@if( $info->banco === 'Itaú') selected @endif>Itaú</option>
                                  <option value="Banco Falabella"@if( $info->banco === 'Banco Falabella') selected @endif>Banco Falabella</option>
                                  <option value="Banco Ripley"@if( $info->banco === 'Banco Ripley') selected @endif>Banco Ripley</option>
                                  <option value="Banco Consorcio"@if( $info->banco === 'Banco Consorcio') selected @endif>Banco Consorcio</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group"><label for="cuenta" class="col-md-4 control-label">Cuenta</label>
                            <div class="col-md-8"><input id="cuenta" type="text" class="form-control" name="cuenta" value="{{ $info->cuenta }}" autofocus></div>
                        </div>

                        <div class="form-group"><label for="password" class="col-md-4 control-label">Password:</label>
                            <div class="col-md-8"><input id="password" name="password" type="password" class="form-control" value=""></div>
                        </div>

                        <div class="form-group"><label class="col-md-4 control-label">Confirmar password:</label>
                          <div class="col-md-8"><input id="password_confirmation" name="password_confirmation" type="password" class="form-control" value=""></div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-4 control-label"></label>
                          <div class="col-md-8">
                            <div class="col-md-4 "><input type="reset" class="btn btn-default btn-block" onclick="location.href='{{ url('home') }}" value="Cancelar"></div>
                            <div class="col-md-4 "><button type="submit" class="btn btn-primary btn-block">Actualizar Datos</button></div>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript1')
<script src="{{ url('/summernote/summernote.js') }}"></script>
<script src="{{ url('/summernote/lang/summernote-es-ES.js') }}"></script>
<script src="{{ asset('js/fileinput.min.js')}}"></script>
<script src="{{ asset('js/locales/es.js')}}"></script>
<script src="{{ asset('js/theme.min.js')}}"></script>
@endsection

@section('javascript2')
<script>
$(document).ready(function() {
  $('#descripcion').summernote({
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['para', ['ul', 'ol', 'paragraph']]
      ],
    lang: 'es-ES',
    disableDragAndDrop: true,
    height: 200
  });


  $("#imagenes").fileinput({
    showUpload: false,
    theme: "explorer",
    language: 'es',
    allowedFileExtensions: ['jpg', 'png'],
    maxFileCount: 5,
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
