@extends("plantilla.template")
@section("encabezados")
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/services_styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/services_responsive.css') }}">
@endsection
<div class="image_boxes" style="margin-top: 50px;">

	<div class="container">
		<h1 style="text-align: center"> Descuentos</h1>
		@empty($prods["promocion"])
			<div class="alert alert-warning" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				No existe ninguna Descuento Actualmente
			</div>
		@else
			@foreach($prods["promocion"] as $promocion)
				<h2>{{$promocion -> nombre}}</h2>
				<p>Desde {{$promocion -> fehcainicio}} hasta {{$promocion -> fechafinal}}</p>

				<div class="row">

					@foreach($promocion -> productos as $vp)
						@if(in_array($vp -> id, $promocion -> pp))
							<div class="col-lg-4 image_box_col" style="margin-bottom: 20px;">
								<div class="card trans_300">
									<img class="card-img-top" src="{{ ($vp -> imagen != null) ? asset(Storage::url($vp -> imagen)) : asset(Storage::url("sinimagen.png"))}}" alt="Card image cap">
									<div class="card-body">
										<h3 class="card-title"><strong>{{$vp -> nombre}}</strong></h3>
										<p class="card-text">

											Descripcion: <b>{{ $vp -> descripcion }}</b> <br>
											Existencia: <b>{{ $vp -> stock }}</b> <br>
											Precio Original: <b>{{ $vp -> precio }}</b> <br>
											Descuento: <b>{{$vp -> pivot -> porcentaje}}</b> <br><br>
											Precio Final: <b>{{$vp -> precio - (($vp -> precio * $vp -> pivot -> porcentaje) / 100)}}</b> <br>
										</p>

										<a href="#" class="card-link" data-toggle="modal" data-target="#modal-compras" onclick="abrirModalCompras({{ json_encode($vp)}}, {{$promocion}}, {{$vp -> pivot -> porcentaje}});">Añadir al carrito</a>

									</div>
								</div>
							</div>
						@endif
					@endforeach
				</div>
			@endforeach

		@endif
	</div>
</div>


<div class="h_slider_container services_slider_container">
	<div class="service_slider_outer">
		<!-- Services Slider -->
		<div class="container">
			<h2 style="text-align: center"><strong>Productos sin promocion</strong></h2>
		</div>
		<div class="owl-carousel owl-theme services_slider">
			@foreach($prods["productos"] as $p)
				<div class="owl-item services_item">
					<div class="services_item_inner">
						<div class="service_item_content">
							<div class="service_item_title">
								<div class="service_item_icon">
									<img class="card-img-top" src="{{ ($p -> imagen != null) ? asset(Storage::url($p -> imagen)) : asset(Storage::url("sinimagen.png"))}}" alt="Card image cap" width="100px" height="60px">
								</div>
								<h2>{{ $p->nombre }}</h2>
							</div>
							<p >
								Descripcion: <b>{{ $p->descripcion }}</b> <br>
								Precio: <b>{{ $p->precio }}</b> <br>
								Existencia: <b>{{ $p->stock }}</b> <br>
							</p>

							<div class="button service_item_button trans_200">
								<a href="#" class="trans_200" data-toggle="modal" data-target="#modal-compras" onclick="abrirModalCompras({{ json_encode($p)}}, {{null}});">

									Añadir al carrito
								</a>

							</div>
						</div>
					</div>
				</div>

			@endforeach
			<div class="services_slider_nav services_slider_nav_left"><i class="fas fa-chevron-left trans_200"></i></div>
			<div class="services_slider_nav services_slider_nav_right"><i class="fas fa-chevron-right trans_200"></i></div>

		</div>
	</div>
</div>
