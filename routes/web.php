<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require_once(__DIR__."/rutas-rest.php");

Route::get('/', function () {
    return view('welcome');
}) -> name ("welcome");
Route::get('/configuracion/impuestos', function () {
    return view('Configuracion.Admin.impuestos');
}) -> name ("confImpuestos");

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('/register/{cliente}', function($cliente){
    return view('cliente.registro', compact("cliente"));
})->name('registroCliente');

Route::get('/prueba/', function(){
    return view('pruebas.prueba');
});

Route::get('/register/valida/{telefonos}/{emails}', 'Auth\RegisterController@variableSession');

Route::get("calcularedad/{fechaNacimiento}", 'HomeController@calcularFecha');
Route::get("calcularPagina/{indice}", 'HomeController@calcularPagina');


Route::resource("promocion","ControlPromocion");
Route::resource("producto","ControlProducto");
Route::resource("venta","ControlVenta");
Route::resource("cliente","ControlCliente");
Route::resource("datoFiscal", "ControlDatoFiscal");
Route::resource("email", "ControlEmail");
Route::resource("devolucion", "ControlDevolucion");


Route::group(['prefix' => 'ajax'], function() {


    Route::post("compras/productos","ControlVenta@productosAjax")->name("venta.productosAjax");
    Route::post("compras/carrito","ControlVenta@carrito");
    Route::get("compras/eliminar/producto/{id}","ControlVenta@eliminarProdCarrito");
    Route::get("carrito/cancelar","ControlVenta@cancelarCompra");
    Route::post("compras/store","ControlVenta@store");

    Route::post("promocion/productos", "ControlPromocion@productosAjax") -> name("promocion.productosAjax");
    Route::post("compras/cliente/verificarDatoFiscal/emails", "ControlVenta@emailsAjax") -> name("datoFiscal.emailsAjax");
    Route::post("compras/cliente/verificarDatoFiscal/telefonos", "ControlVenta@telefonosAjax") -> name("datoFiscal.telefonosAjax");
    Route::post("compras/cliente/verificarDatoFiscal/agregarEmail", "ControlEmail@store") -> name ("datoFiscal.creaNuevoCorreo");
    Route::post("compras/cliente/verificarDatoFiscal/agregarTelefono", "ControlTelefono@store") -> name ("datoFiscal.creaNuevoTelefono");

    Route::post("promocion/agregar", "ControlPromocion@store") -> name("promocion.agregar");
    //Route::get("compras/cliente/verificarDatoFiscal/factura", "ControlVenta@generarPDF") -> name ("generarFacturaPDF");



    /************************ SCM ************************/
    Route::post("materia/buscar","ControlProvisiona@materiaSearch")->name("materias.search");
    Route::post("provisiona/guardar","ControlProvisiona@guardaMateria");
    Route::get("provisiona/eliminar/materia/{id}","ControlProvisiona@eliminarMateriaProvisiona");
    Route::get("provisiona/cancelar","ControlProvisiona@cancelarProvisiona");
    Route::post("provisiona/store","ControlProvisiona@store");
    Route::get("provisiona/destroy/{id}","ControlProvisiona@destroy");

    Route::post("metodo/materia/buscar","ControlMetodoFabrica@materiaSearch")->name("metodo.materias.search");
    Route::post("metodofabrica/materia/guardar","ControlMetodoFabrica@guardaMateria");
    Route::get("metodo/eliminar/materia/{id}","ControlMetodoFabrica@eliminarMateria");
    Route::get("metodo/cancelar","ControlMetodoFabrica@cancelarMetodoFabrica");
    Route::post("metodofabrica/store","ControlMetodoFabrica@store");
    Route::get("metodofabrica/eliminar/{id}","ControlMetodoFabrica@destroy");
    Route::post("metodofabrica/recargaSelecMetodo","ControlMetodoFabrica@recargaSelecMetodo");
    Route::post("metodofabrica/materiasOcupa","ControlMetodoFabrica@materiasOcupa");

    Route::post("produccion/recarga","ControlProduccion@recarga");
    Route::post("produccion/materiasOcupa","ControlProduccion@materiasOcupa");
    Route::get("produccion/eliminar/{id}","ControlProduccion@destroy");

    /************************ FIN ************************/



});



Route::get("compras/cliente/factura/pdf", "ControlVenta@verificarDF") -> name ("verificar.DatoFiscal");
Route::post("compras/cliente/factura/envio", "ControlVenta@facturar") -> name ("venta.factura");

Route::get("carrito/compras","ControlVenta@listaCarrito")->name("venta.carrito");
Route::get("compras/cliente","ControlVenta@verComprasCliente")->name("cliente.compras");

/************************ Inicio Nuevas Rutas CRM ************************/
Route::resource("configuracion","Configuracion\ControlAdmin");
Route::resource("perfil","Configuracion\ControlCliente");

/************************ Fin Nuevas Rutas CRM ************************/


/************************ SCM ************************/
Route::get('/home', 'HomeController@index')->name('home');

Route::resource("proveedor","ControlProveedor");
Route::resource("materia","ControlMateriaprima");
Route::resource("provisiona","ControlProvisiona");

Route::resource("medida","ControlUnidadmedida");
Route::resource("metodofabrica","ControlMetodoFabrica");
Route::resource("produccion","ControlProduccion");


Route::post("medida/updateOtro","ControlUnidadmedida@updateOtro")->name("updateOtro");
Route::get("pdf/produccion","ControlProduccion@pdfProduccion")->name("pdf.produccion");

/************************ FIN ************************/