@extends('layouts.app')

@section('title', 'Mis Ventas')

@section('content')

<div class="container">
    <h1>Mis Ventas</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td class="text-center">Aviso</td>
                <td class="text-center">Comprador</td>
                <td class="text-center">Precio</td>
                <td class="text-center">Fecha Compra</td>
                <td class="text-center">Comprobante</td>
            </tr>
        </thead>
        <tbody>
        @foreach($compras as $key => $compra)
            <tr>
                <td class="text-center">{{ $compra->titulo }}</td>
                <td class="text-center">{{ $compra->name }}</td>
                <td class="text-center">{{ $compra->precio }}</td>
                <td class="text-center">{{ $compra->fechaCompra }}</td>
                <td class="text-center"><button type="button" class="btn btn-info view-pdf" href="{{ url($compra->comprobante) }}"><span class="glyphicon glyphicon-file"></span></button> </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('javascript1')
<script src="{{ asset('js/modal-preview.js') }}"></script>
<script>
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
</script>
@endsection
