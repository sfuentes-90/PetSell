@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Secretarias</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td class="text-center">Nombre</td>
                <td class="text-center">Email</td>
                <td class="text-center">Fecha Creación</td>
                <td class="text-center">Editar</td>
            </tr>
        </thead>
        <tbody>
        @foreach($avisos as $key => $secretaria)
            <tr>
                <td class="text-center">{{ $secretaria->nombre }}</td>
                <td class="text-center">{{ $secretaria->email }}</td>
                <td class="text-center">{{ $secretaria->created_at }}</td>
                <td class="text-center"><a class="btn btn-small btn-info" href="{{ url('#') }}" data-id="{{ $secretaria->id }}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil"></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Form-->
<div class="modal fade" id="modalComentario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Enviar Comentario</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <form role="form" id="formComentario">

                  <div class="form-group">
                      <label for="comentario">Comentario</label>

                      <input type="text" class="form-control" name="comentario" id="comentario" placeholder="Escriba un comentario..." value="" autofocus>
                  </div>
                  <div class="form-group">
                      <input type="hidden" class="form-control" name="idAvisoHidden", id="idAvisoHidden" value="">
                  </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
                <button type="submit" class="btn btn-primary" id="modal-submit" data-id=""><i class="glyphicon glyphicon-ok"></i> Enviar</button>
            </div>
        </div>
    </div>
</div>

@endsection
