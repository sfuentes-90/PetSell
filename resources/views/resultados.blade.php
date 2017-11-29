@extends('layouts.app')

@section('title', 'Resultados Busqueda')

@section('content')
<div class="container">
  <form>
    <div class="form-group">
      <legend>Filtros:</legend>
      <div class="col-md-3">
        <label for="region" class="control-label">Region</label>
        <select class="form-control" id="region" name="region">
          <option value="0">Región</option>
          <option value="&region=Arica y Parinacota">Arica y Parinacota</option>
          <option value="&region=Tarapaca">Tarapaca</option>
          <option value="&region=Antofagasta">Antofagasta</option>
          <option value="&region=Atacama">Atacama</option>
          <option value="&region=Coquimbo">Coquimbo</option>
          <option value="&region=Valparaiso">Valparaiso</option>
          <option value="&region=O'Higgins">O'Higgins</option>
          <option value="&region=Metropolitana">Metropolitana</option>
          <option value="&region=Maule">Maule</option>
          <option value="&region=Bio Bio">Bio Bio</option>
          <option value="&region=Araucania">Araucania</option>
          <option value="&region=Los Rios">Los Rios</option>
          <option value="&region=Los Lagos">Los Lagos</option>
          <option value="&region=Aysen">Aysen</option>
          <option value="&region=Magallanes">Magallanes</option>
        </select>
        <br>
        <label for="categoria" class="control-label">Categoria</label>
        <select class="form-control" id="categoria" name="categoria">
          <option value="0">Categoria</option>
          <option value="&categoria=1">Categoria 1</option>
          <option value="&categoria=2">Categoria 2</option>
          <option value="&categoria=3">Categoria 3</option>
          <option value="&categoria=4">Categoria 4</option>
          <option value="&categoria=5">Categoria 5</option>
          <option value="&categoria=6">Categoria 6</option>
        </select>
      </div>
    </div>

  </form>
  <div class="col-md-8">
    @foreach ($resultados as $resultado)
        @include('searchItem')
    @endforeach
    {{ $resultados->links() }}
  </div>
</div>
@endsection

@section('javascript1')
<script>
$(document).ready( function() {
    $('#region').bind('change', function () {
        var brwsr_url=document.URL;
        var redirecturl= brwsr_url + $(this).val();
        location.href = redirecturl;
   });
   $('#categoria').bind('change', function () {
       var brwsr_url=document.URL;
       var redirecturl= brwsr_url + $(this).val();
       location.href = redirecturl;
  });
});
</script>
@endsection
