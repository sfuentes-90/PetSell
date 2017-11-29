@extends('layouts.app')

@section('title', 'Home')

@section('style')
<link rel="stylesheet" href="{{ asset('css/carrusel.css') }}">
@endsection

@section('content')
    <div class="container">
        @include('welcomeItems.carrusel')
        @include('welcomeItems.destacados')
        @include('welcomeItems.categorias')
    </div>
@endsection
