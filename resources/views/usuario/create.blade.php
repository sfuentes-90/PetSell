@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ url('/summernote/summernote.css') }}">
<link rel="stylesheet" href="{{ asset('css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
@endsection

@section('title', 'Crear Aviso')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Aviso</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group"><label for="titulo" class="col-md-4 control-label">Titulo</label>
                            <div class="col-md-8"><input id="titulo" type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" required autofocus></div>
                        </div>

                        <div class="form-group"><label for="descripcion" class="col-md-4 control-label">Descripcion</label>
                            <div class="col-md-8">
                              <textarea id="descripcion" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>
                              </textarea>
                            </div>
                        </div>

                        <div class="form-group"><label for="precio" class="col-md-4 control-label">Precio</label>
                            <div class="col-md-8"><input id="precio" type="text" class="form-control" name="precio" value="{{ old('precio') }}" required autofocus></div>
                        </div>

                        <div class="form-group"><label for="categoria" class="col-md-4 control-label">Categoria</label>
                            <div class="col-md-8">
                                <select class="form-control" id="idCategoria" name="idCategoria">
                                    @foreach ($categorias as $cat) {
                                    <option value="{{ $cat->id }}">{{ $cat->nombreCategoria }}</option>
                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label for="region" class="col-md-4 control-label">Region</label>
                            <div class="col-md-8">
                                <select class="form-control" id="region" name="region">
                                  <option value="0">Región</option>
                                  <option value="Arica y Parinacota">Arica y Parinacota</option>
                                  <option value="Tarapaca">Tarapaca</option>
                                  <option value="Antofagasta">Antofagasta</option>
                                  <option value="Atacama">Atacama</option>
                                  <option value="Coquimbo">Coquimbo</option>
                                  <option value="Valparaiso">Valparaiso</option>
                                  <option value="O'Higgins">O'Higgins</option>
                                  <option value="Metropolitana">Metropolitana</option>
                                  <option value="Maule">Maule</option>
                                  <option value="Bio Bio">Bio Bio</option>
                                  <option value="Araucania">Araucania</option>
                                  <option value="Los Rios">Los Rios</option>
                                  <option value="Los Lagos">Los Lagos</option>
                                  <option value="Aysen">Aysen</option>
                                  <option value="Magallanes">Magallanes</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group"><label for="imagenes" class="col-md-4 control-label">Imagen 1</label>
                            <div class="col-md-8"><input id="imagenes" type="file" class="form-control" name="imagenes[]" multiple></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4"><button type="submit" class="btn btn-primary">Crear Aviso</button></div>
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
