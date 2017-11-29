@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')
  <div class="container" id="box-container">
		<div class="row align-middle">
	    <div id="box" class="col-md-6">
        <a href="{{ url('admin/avisos') }}" id="link"><span class="	glyphicon glyphicon-ok"></span><i> Validar Avisos</i></a>
      </div>
		  <div id="box" class="col-xs-6">
        <a href="{{ url('admin/membresias') }}" id="link"><span class="glyphicon glyphicon-star-empty"></span><i> Validar Membresias</i></a>
      </div>
    </div>
    @if( Auth::id() === 1)
      @include('admin.home-extended')
    @endif
  </div>
@endsection
