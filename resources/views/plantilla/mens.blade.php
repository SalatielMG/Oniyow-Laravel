<?php
	$m = [
		"ok-create"=>[
			"msj" => "Categoria Creada",
			"style" => "alert-primary",
		],
		"error-create"=>[
			"msj" => "Error al crear la Categoria",
			"style" => "alert-danger",
		],
		"error-show"=>[
			"msj" => "No existe la categoria seleccionada",
			"style" => "alert-danger",
		],
		"error-show-login" => [
			"msj" => "Error, usuario y/o contraseña no encontrado",
			"style" => "alert-danger",
		],
		//Codigo agregado
			"ok-create-producto"=>[
					"msj" => "Producto Creado corectamente",
					"style" => "alert-primary",
			],
			"error-create-producto"=>[
					"msj" => "Error al crear el Producto",
					"style" => "alert-danger",
			],
			"ok-edit-producto"=>[
					"msj" => "Producto actualizado correctamnete",
					"style" => "alert-primary",
			],
			"error-edit-producto"=>[
					"msj" => "Error al actualizar el Producto",
					"style" => "alert-danger",
			],
			"ok-delete-producto"=>[
					"msj" => "Producto Eliminado",
					"style" => "alert-success",
			],
			"error-delete-producto"=>[
					"msj" => "Error al eliminar el Producto",
					"style" => "alert-danger",
			],
			"ok-create-datoFiscal-Admin"=>[
					"msj" => "Datos Fiscales Agregado Correctamente",
					"style" => "alert-success",
			],
			"error-create-datoFiscal-Admin"=>[
					"msj" => "Error al Crear los datos Fiscales",
					"style" => "alert-danger",
			],

	];

?>

@if(!empty($e) && array_key_exists($e, $m))
	<div class="alert {{ $m[$e]['style'] }}" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	  			<span aria-hidden="true">&times;</span>
			</button>
	        <strong>{{ $m[$e]['msj'] }}</strong>
	</div>
@endif