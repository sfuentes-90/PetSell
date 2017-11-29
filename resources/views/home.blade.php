@extends('layouts.app')

@section('title', 'Mi perfil')

@section('content')
    <div class="container" id="box-container">
    		<div class="row align-middle">
      	    <div id="box" class="col-md-6">
                <a href="{{ url('user/vender') }}" id="link"><span class="glyphicon glyphicon-shopping-cart"></span><i>Mis Compras</i></a>
            </div>
      			<div id="box" class="col-xs-6">
                <a href="{{ url('user/avisos/create') }}" id="link"><span class="glyphicon glyphicon-pencil"></span><i>Publicar Aviso</i></a>
            </div>
          </div>
          <div class="row">
        		<div id="box" class="col-md-6">
                <a href="{{ url('user/avisos') }}" id="link"><span class="glyphicon glyphicon-list-alt"></span><i>Mis Avisos</i></a>
            </div>
        		<div id="box" class="col-md-6">
                <a href="{{ url('user/info') }}" id="link"><span class="glyphicon glyphicon-user"></span><i>Mi Cuenta</i></a>
            </div>
        </div>
    </div>
@endsection
