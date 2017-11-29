@extends('layouts.app')

@section('title', 'Planes')

@section('style')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
<div class="container">
<section class="content-well vps">
	    <div class="inner-wrapper --lg">
				<h4 class="headline _feature">Elije tu Plan</h4>
				<div class="block_wrap">
					<div class="block-cont">
						<a href="{{ url('user/comprar_membresia', 1)}}">
						<h4 class="title">1 Mes</h4>
						<p class="price">$4.990</p>
						<span class="btn-info btn-lg btn-block">Comprarlo!</span>
						</a>
					</div>
				</div>
				<div class="block_wrap">
					<div class="block-cont highlight">
						<a href="{{ url('user/comprar_membresia', 2)}}">
						<h4 class="title">3 Meses</h4>
						<p class="price">$9.990</p>
						<span class="btn-info btn-lg btn-block">Comprarlo!</span>
						</a>
					</div>
				</div>
				<div class="block_wrap">
					<div class="block-cont">
						<a href="{{ url('user/comprar_membresia', 3)}}">
						<h4 class="title">6 Meses</h4>
						<p class="price">$15.990</p>
						<span class="btn-info btn-lg btn-block">Comprarlo!</span>
						</a>
					</div>
				</div>
				<div class="block_wrap">
					<div class="block-cont">
						<a href="{{ url('user/comprar_membresia', 4)}}">
						<h4 class="title">1 Año</h4>
						<p class="price">$20.990</p>
						<span class="btn-info btn-lg btn-block">Comprarlo!</span>
						</a>
					</div>
				</div>
	    </div>
</section>
</div
@endsection
