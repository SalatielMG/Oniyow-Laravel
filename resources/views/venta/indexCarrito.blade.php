@extends("plantilla.template")
@section("contenido1")
	@include("plantilla.borde")
	<div class="services">
	<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title">
						<h2>Lista de productos</h2>
						<!--h1>RanGO. We take care of your business</h1>
						<span>Explore our services</span-->
					</div>
				</div>
			</div>
		<br>
	@if(!empty($carrito))
		@php
			$x = 1;
			$total = 0;	
		@endphp
		<table class="table table-hover">
			<tr>
				<th>#</th>
				<th>Producto</th>
				<th>Cantidad</th>
				<th>Precio Original</th>
				<th>Promocion</th>
				<th>SubTotal</th>
				<th></th>
			</tr>
		@foreach($carrito as $c)
			@php
				$precio = $c["precio"] - (($c["precio"] * $c["porcentaje"]) / 100);
				$st = $c["cantidad"] * $precio;
				$total += $st;
			@endphp
			<tr>
				<td>{{ $x++ }}</td>
				<td>{{ $c["nombre"] }}</td>
				<td>{{ $c["cantidad"] }}</td>
				<td>${{ number_format($c["precio"], 2, ".", "") }}</td>
				<td>{{ ($c["porcentaje"] == 0) ? "NA": $c["porcentaje"] . "%" }}</td>
				<td>${{ number_format($st, 2, ".", "") }} </td>
				<td><a href="#" class="btn btn-warning" onclick="eliminarProdCompras({{ $c["id"] }})">Eliminar</a></td>
			</tr>
		@endforeach
			<tr>
				<td colspan="5" align="right"><strong>Total</strong></td>
		        <td>${{ number_format($total,2,".","") }} </td>
		        <td>
		        	<button href="#" id="aceptar" onclick="guardarCompra()" class="btn btn-success">Comprar</button>
		        	<button href="#" id="cancelar" onclick="cancelarCompras()" class="btn btn-danger">Cancelar</button>
		        </td>
			</tr>
		</table>
	@else
		 <div class="alert alert-warning" role="alert">
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  			<span aria-hidden="true">&times;</span>
			</button>
        	Carrito sin productos
    	</div> 
	@endif
	</div></div>
@endsection