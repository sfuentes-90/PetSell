@extends('layouts.app')

@section('title', 'Publicaciones Inactivas')

@section('content')
<div class="container">
    <h1>Avisos Inactivos</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td class="text-center">Fecha Solicitud</td>
                <td class="text-center">Fecha Edición</td>
                <td class="text-center">Usuario</td>
                <td class="text-center">Valor Membresia</td>
                <td class="text-center">Comprobante</td>
                <td class="text-center">Activar</td>
                <td class="text-center">Rechazar</td>
            </tr>
        </thead>
        <tbody>
        @foreach($avisos as $key => $aviso)
            <tr>
                <td class="text-center">{{ \Carbon\Carbon::parse($aviso->created_at)->format('d/m/Y') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($aviso->updated_at)->format('d/m/Y') }}</td>
                <td class="text-center">{{ $aviso->name }}</td>
                <td class="text-center">{{ $aviso->precio }}</td>
                <td class="text-center"><button type="button" class="btn btn-info view-pdf" href="{{ url($aviso->comprobante) }}"><span class="glyphicon glyphicon-file"></span></button> </td>
                <td class="text-center"><a class="btn btn-small btn-success" href="{{ url('admin/activar_membresia', $aviso->id) }}"><span class="glyphicon glyphicon-ok"></a></td>
                <td class="text-center"><a class="btn btn-small btn-danger" data-toggle="modal" data-target="#modalComentario" data-solicitud-id="{{ $aviso->id }}"><span class="glyphicon glyphicon-remove"></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Preview -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-body">
         <iframe src="" id="modeliframe"></iframe>
       </div>
    </div>
  </div>
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

@section('javascript1')
<script src="http://codegena.com/assets/js/image-preview-for-link.js"></script>
<script src="{{ asset('js/modal-preview.js') }}"></script>
@endsection

@section('javascript2')
<script type="text/javascript">
$(function(){
  $('.view-pdf').on('click',function(){
      var pdf_link = $(this).attr('href');
      var iframe = '<div class="iframe-container"><iframe src="'+pdf_link+'"></iframe></div>'
      $.createModal({
      title:'Comprobante',
      message: iframe,
      closeButton:true,
      });
      return false;
  });
})

// Setear ID del modal
$('#modalComentario').on('show.bs.modal', function(e) {
    var avisoId = $(e.relatedTarget).data('solicitud-id');
    $('#modal-submit').data('id',avisoId);
    $("#idAvisoHidden").val(avisoId);
});

// autofocus
$('#modalComentario').on('shown.bs.modal', function() {
  $(this).find('input:first').focus();
});

// Enviar Formulario
$(function(){
    $('#modal-submit').on('click', function(e){
        var id = $('#idAvisoHidden').val();
        var comentario = $('#comentario').val();
        var token = $('#_token').val();

        console.log('id: ' + id + '\ncomentario: ' + comentario + '\ntoken: ' + token);
        e.preventDefault();
        $.ajax({
            url: "{{ url('admin/rechazar_membresia') }}",
            type: 'POST',
            data: { 'id' : id, 'comentario' : comentario  },
            headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
            success: function(data){
              location.reload();
            },
            error: function(data){
              console.log("error ");
              alert('No se pudo enviar el comentario.')
            }
        });
    });
});
</script>
@endsection
