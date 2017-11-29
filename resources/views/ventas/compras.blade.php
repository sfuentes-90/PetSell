@extends('layouts.app')

@section('title', 'Mis Compras')

@section('content')

<div class="container">
    <h1>Todas mis compras</h1>
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td class="text-center">Titulo</td>
                <td class="text-center">Vendedor</td>
                <td class="text-center">Precio</td>
                <td class="text-center">Fecha Compra</td>
                <td class="text-center">Valorar</td>
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
                <td class="text-center">
                  @if ( $compra->valorada === 0)
                    <button type="button" class="btn btn-success" onclick="location.href='{{ url('user/valorar_positiva', $compra->id) }}';"><span class="glyphicon glyphicon-thumbs-up"></span></button>
                    <button type="button" class="btn btn-danger"  onclick="location.href='{{ url('user/valorar_negativa', $compra->id) }}/';"><span class="glyphicon glyphicon-thumbs-down"></span></button>
                  @else
                    <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-saved"></span></button>
                  @endif
                </td>
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
