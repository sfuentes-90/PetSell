@extends('layouts.app')

@section('title', 'Mis Publicaciones')

@section('content')
<div class="container">
    <center><h1>Mis avisos</h1></center>
    <div class="col-md-4">
      <label for="estado" class="control-label">Estado</label>
      <select class="form-control" id="estado" name="estado">
        <option value="0">Estado</option>
        <option value="?estado=1">Activo</option>
        <option value="?estado=0">Inactivo</option>
        <option value="?estado=-1">Rechazado</option>
      </select>
      <br>
    </div>
  <div class="row">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td class="text-center">Titulo</td>
                <td class="text-center">Precio</td>
                <td class="text-center">Categoria</td>
                <td class="text-center">Estado</td>
                <td class="text-center">Cant. Ventas</td>
                <td class="text-center">Mostrar</td>
                <td class="text-center">Editar</td>
                <td class="text-center">Ventas</td>
            </tr>
        </thead>
        <tbody>
        @foreach($avisos as $key => $aviso)
            <tr>
                <td class="text-center">{{ $aviso->titulo }}</td>
                <td class="text-center">{{ $aviso->precio }}</td>
                <td class="text-center">{{ $aviso->nombreCategoria }}</td>
                <td class="text-center">@if ($aviso->activo == 1 ) Activo @elseif($aviso->activo == 0 ) Inactivo @else Rechazado @endif</td>
                <td class="text-center">{{ $aviso->ventas }}</td>
                <td class="text-center"><a class="btn btn-small btn-success" href="{{ url('avisos', $aviso->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                <td class="text-center"><a class="btn btn-small btn-info" href="{{ url('avisos', $aviso->id).'/edit' }}"><span class="glyphicon glyphicon-pencil"></a></td>
                <td class="text-center"><a class="btn btn-small btn-default " href="{{ url('user/ventas', $aviso->id) }}"><span class="glyphicon glyphicon-credit-card"></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $avisos->links() }}
@endsection

@section('javascript1')
<script>
$(document).ready( function() {
   $('#estado').bind('change', function () {
     var brwsr_url=document.URL;
      brwsr_url = brwsr_url.split('?');
      brwsr_url = brwsr_url[0];
      var redirecturl= brwsr_url + $(this).val();
      location.href = redirecturl;
  });
});
</script>
@endsection
