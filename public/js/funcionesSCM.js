
function materias(url){
    var b = $("#buscar").val();
    $.post(url,{buscar:b},function(data){

        $("#materiasAjax").html(data);
    });
}


var idMateria = 0;
function abrirModalProvisiona(p){
    $("#nombre").val(p.nombre);
    $("#precio").val(p.precio);
    $("#cantidad").val(1);
    $("#total").val( 1);
    //$("#id-prod").val(p.idProd);
    idMateria = p.id;

    $("#medida").val(p.medida);
}

function calculaTotalModalProvisiona(){
    var cant = $("#cantidad").val();
    var precio = $("#precio").val();
    try{
        cant = parseInt(cant);
        precio = parseFloat(precio);
        if(cant > 0){
            $("#total").val(precio * cant);
            $("#msjC").html("");
        }else{

            $("#msjC").html("la cantidad tiene que ser mayor a 0");
            $("#cantidad").focus();
        }


    }catch(e){
        alert("Error");
    }
}

function guardaMateriaDentroProvisiona(){
    var cantidad = $("#cantidad").val();
    var precio = $("#precio").val();
    $.post(app + "/ajax/provisiona/guardar",{cantidad:cantidad,precio:precio,id:idMateria},function(d){

        if(d != null){
            //$("#badge").html(d.cant);
            $("#modal-provisiona").modal('hide');
            $("#materiasCompradas").html(d);


        }else{
            alert("Error al procesar");
        }
    });
}

function guardarCompraProvisiona(){
    $("#aceptar").html("Procesando Compra...");
    $("#aceptar").attr("disabled",true);
    $("#cancelar").attr("disabled",true);

    var proveedor = $("#proveedor").val();

    $.post(app + "/ajax/provisiona/store",{proveedor:proveedor},function(d){
        if(d.r){
            document.location.href = app + "/provisiona";
        }else{
            $("#aceptar").html("Comprar");
            $("#aceptar").removeAttr("disabled");
            $("#cancelar").removeAttr("disabled");
            alert(d.msj);
        }
    });
}


function eliminarMateriaDentroProvisiona(id){
    var c = confirm("desea confirmas la eliminacion?");

    if(c){
        $.get(app + "/ajax/provisiona/eliminar/materia/" + id , function (d) {
            document.location.href = app + "/provisiona/create"
        });
    }
}

function cancelarCompraProvisiona(){
    var c = confirm("Seguro de Eliminar la compra al proveedor?");

    if(c){
        $.get(app + "/ajax/provisiona/cancelar", function (d) {
            document.location.href = app + "/provisiona/create"
        });
    }
}

function deleteProvisiona(id){
    var c = confirm("Seguro de Eliminar la Compra "+id);

    if(c){
        $.get(app + "/ajax/provisiona/destroy/"+id, function (d) {
            document.location.href = app + "/provisiona"
        });
    }
}





/* UNIDAD DE MEDIDA*/

var idMedida = 0;


function modalUpdateMedida(p){
    $("#nombreE").val(p.medida);
    $("#idE").attr("value",p.id);
    //$("#form-modal").attr("action",'{{ route("medida.update",'+p.id+') }}');

}



/* METODO DE FABRICA */

function guardaMateriaDentroMetodo(){
    var cantidad = $("#cantidad").val();
    $.post(app + "/ajax/metodofabrica/materia/guardar",{cantidad:cantidad,id:idMateria},function(d){
        if(d != null){
            //$("#badge").html(d.cant);
            $("#modal-provisiona").modal('hide');
            $("#materiasEnOcupa").html(d);

        }else{
            alert("Error al procesar");
        }
    });
}


function metodoEliminarMateria(id){
    var c = confirm("desea confirmas la eliminacion?");

    if(c){
        $.get(app + "/ajax/metodo/eliminar/materia/" + id , function (d) {
            document.location.href = app + "/metodofabrica/create"
        });
    }
}

function metodoCancelar(){
    var c = confirm("Seguro de Eliminar el proceso de fabricacion?");

    if(c){
        $.get(app + "/ajax/metodo/cancelar", function (d) {
            document.location.href = app + "metodofabrica/create"
        });
    }
}


function metodoGuardar(){
    $("#aceptar").html("Procesando Compra...");
    $("#aceptar").attr("disabled",true);
    $("#cancelar").attr("disabled",true);

    var producto = $("#producto").val();
    var nombre = $("#nombreProceso").val();
    var descripcion = $("#descripcion").val();

    $.post(app + "/ajax/metodofabrica/store",{producto:producto,nombre:nombre,descripcion:descripcion},function(d){
        if(d.msj){
            //if(d.error != "")
            document.location.href = app + "/metodofabrica";
        }else{
            $("#aceptar").html("Comprar");
            $("#aceptar").removeAttr("disabled");
            $("#cancelar").removeAttr("disabled");
            alert(d.msj);
        }
    });
}

function eliminarMetodo(id,total) {
    var c = confirm("Seguro de Eliminar el Método de Fábrica "+id);
    var x;
    console.log(total);
    if(c){
        if(total > 0){
            x = confirm("El metodo se ha utilizado para "+total+" producciones\n ¿Seguro de eliminarlo?");
        }
        if(x){
            $.get(app + "/ajax/metodofabrica/eliminar/"+id, function (d) {
                document.location.href = app + "/metodofabrica";
            });
        }

    }
}














/* PRODUCCION*/

function cambiaSelectProductos(){
    var select = document.getElementById("producto");
    var options=document.getElementsByTagName("option");
    //console.log(select.value); //Valor del select seleccionado
    //console.log(options[select.value-1].innerHTML) //Nombre del select seleccionado
    recargaSelect(app + "/ajax/produccion/recarga",select.value)

}


function recargaSelect(url,id){


    $.post(url, {id:id}, function(d){
        var select = document.getElementsByName("metodo")[0]; //Obtiene el primer value=idProducto
        $("#metodo").empty();


        if(d.contar == 0){
            //$("#materiasEnOcupa").html("");
            var option = document.createElement("option");
            option.text = "No hay metodos de produccion de este producto";
            option.value = 0;
            select.add(option);
            $("#materiasEnOcupa").html("");
        }else{
            var option = document.createElement("option");

            //Agregando por defecto
            //option.text = "Seleccione un metodo de produccion";
            //option.value = 0;
            //select.add(option);
            //Termina agregar por fecto
            //Recargando select
            for (m in d.metodos) {
                var option = document.createElement("option");
                option.text = d.metodos[m].nombre;
                option.value = (d.metodos[m].id);
                select.add(option);
            }
            recargaMateriasOcupadas(d.metodos[0].id);

        }

    });
}

function onChangeMetodo(){
    var select = document.getElementById("metodo");
    var options=document.getElementsByTagName("option");
    //console.log("metodo id "+select.value);
    //console.log(options[select.value-1].innerHTML);
    recargaMateriasOcupadas(select.value);
}

function recargaMateriasOcupadas(id){
    $.post(app + "/ajax/produccion/materiasOcupa",{id:id},function(d){
        if(d != null){
            $("#materiasEnOcupa").html(d);

        }else{
            alert("Error al procesar");
        }
    });
}











/* Ver Metodos de Fabrica*/

function changeSelecProductos(){
    console.log(" changeSelecProductos ");
    var select = document.getElementById("producto");
    recargaSelecMetodo(app + "/ajax/metodofabrica/recargaSelecMetodo",select.value)
}


function recargaSelecMetodo(url,id){
    console.log(" recargaSelecMetodo ");

    $.post(url, {id:id}, function(d){
        //var select = document.getElementsByName("metodo")[0]; //Obtiene el primer value=idProducto
        $("#metodo").empty();


        if(d.total == 0){
            $("#materiasEnOcupa").html("");
            $("#metodo").html(d.html);
        }else{
            $("#metodo").html(d.html);
            recargaTablaMateriasOcupa(d.id);
        }

    });
}

function changeSelectMetodo(){
    console.log(" changeSelectMetodo ");
    var select = document.getElementById("metodo");
    recargaTablaMateriasOcupa(select.value);
}

function recargaTablaMateriasOcupa(id){
    console.log(" recargaTablaMateriasOcupa "+id);
    $.post(app + "/ajax/metodofabrica/materiasOcupa",{id:id},function(d){
        if(d != null){
            $("#materiasEnOcupa").html(d);
        }else{
            alert("Error al procesar");
        }
    });
}








var prueba = "";
function probando(id){
    id = "#"+id;
    $(prueba).removeClass("show");
    prueba = id;
}

var anteriorMetodo = "";
function removeShowMet(actualM){
    actualM = "#"+actualM;
    $(anteriorMetodo).removeClass("show");
    anteriorMetodo = actualM;
}



function borrarProduccion(id) {
    var c = confirm("Seguro de Eliminar la produccion "+id);

    if(c){

        $.get(app + "/ajax/produccion/eliminar/"+id, function (d) {
            document.location.href = app + "/produccion";
        });
    }
}



function abrirNuevaPestana(url) {
    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
}