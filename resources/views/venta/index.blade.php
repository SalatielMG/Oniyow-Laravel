@extends("plantilla.template")
@section("contenido1")
	@include("venta.modalCompras")

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col text-lg-center text-left">
					<div class="newsletter_content">
						<br>
						<!-- Newsletter Title -->
						<div class="newsletter_title">
							<h1>Lista de productos</h1>
							<span>Aqui podras encontrar todos tus productos</span>
						</div>

						<!-- Newsletter Form -->
						<div class="newsletter_form_container">
							<form action="#">
								<div class="input-group">
									<input type="text" class="newsletter_email" placeholder="Buscar producto" required="required" data-error="Buscar un producto correcto." name="buscarP" id="buscarP" onkeyup="productosAjax('{{ route('venta.productosAjax') }}')">
									<button id="newsletter_form_submit" type="submit" class="button newsletter_submit_button trans_200" value="Submit" onclick="productosAjax('{{ route('venta.productosAjax') }}')">
										Buscar
									</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>

	<div id="productosCompra" style="margin-top: -50px">

	</div>
@endsection

@section("script")
	<script type="text/javascript">
		$(document).ready(function(){
			productosAjax('{{ route("venta.productosAjax") }}');
		});
	</script>
@endsection