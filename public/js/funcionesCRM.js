/*const animales = [
    {
        "nombre": "alacran",
        "huave": "napüp",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "coyote",
        "huave": "sampüy",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "ardilla",
        "huave": "ngüin",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "conejo",
        "huave": "coy",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "perro",
        "huave": "pet",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "zorro",
        "huave": "wiül",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "gato",
        "huave": "miüs",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "venado",
        "huave": "xiküw",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "cocodrilo",
        "huave": "jum",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "borrego",
        "huave": "sap",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "chivo",
        "huave": "teants",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "toro",
        "huave": "boy",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "lobo",
        "huave": "pet xiül",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "mariposa",
        "huave": "miük",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "grillo",
        "huave": "lit ongüits",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "codorniz",
        "huave": "ngox",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "buho",
        "huave": "jotjot",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "urraca",
        "huave": "xaw",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "zopilote",
        "huave": "potwit",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "chachalaca",
        "huave": "püüch",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "gallina",
        "huave": "kit",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "tlacuache",
        "huave": "wüy",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "mapache",
        "huave": "mbawüp",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "zorrillo",
        "huave": "lit ongwits",
        "sonido": "",
        "imagen": "",
    },

    {
        "nombre": "guajolote",
        "huave": "tel",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "hormiga",
        "huave": "choc",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "mosca",
        "huave": "mem",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "gallo",
        "huave": "poy",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "cuac",
        "huave": "araña",
        "sonido": "",
        "imagen": "",
    },
    {///
        "nombre": "caballo",
        "huave": "cawüy",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "yegua",
        "huave": "yew",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "burro",
        "huave": "bur",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "iguana",
        "huave": "ix",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "murcielago",
        "huave": "netsam miük",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "oso hormiguero",
        "huave": "cheyey kün",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "coralillo",
        "huave": "ngot nüt",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "abeja",
        "huave": "kün",
        "sonido": "",
        "imagen": "",
    },
    {
        "nombre": "marrano",
        "huave": "sow",
        "sonido": "",
        "imagen": "",
    },

];

var a='perro';



function existeAnimal(animal) {
    console.log(animal.nombre + " == " + a );
    return animal.nombre == a;
}

var found = animales.find(function(animal) {
    console.log(a);
    return animal.nombre == a;
});

//console.log(found);
function buscarAnimal(){
    this.a = $("#buscarV").val().trim();
    //console.log($("#buscarV").val().trim());
    //console.log(a);
    const resultado = animales.findIndex(existeAnimal);
    return resultado;
    //console.log(found);
    //alert(found);
    /*var animall = $("#buscarV").val().trim();
    const resultado = animales.find( animal => animal.nombre === "'" + animall + "'" );
    console.log("Animal buscando :=", animall);
    console.log("resultado :=", resultado);
    alert(resultado);
}*/

function validarCampo(valorCampo, op){
    if(op == "email"){
        if((regex_email).exec(valorCampo)){
            return true
        }
        alert("Ingresa un una direccion de correo valida. ¡ Porfavor !");
        return false;
    }else{
        if((regex_num_celular).exec(valorCampo)){
            return true
        }
        alert("Ingresa un numero telefonico correcto de 10 digitos");
        return false;
    }
}
function add_li(opcion)
{

    var elemento = (opcion == "email") ? "nuevo_email" : "nuevo_telefono";
    var lista = (opcion == "email") ? "listaEmails" : "listaTelefonos";
    var nuevoLi=document.getElementById(elemento).value;
    if(nuevoLi.length>0)
    {
        if(!validarCampo(nuevoLi, opcion)) return;
        var index = find_li(nuevoLi, lista);
        console.log(index);
        if(index != 0)
        {
            var li=document.createElement('li');
            li.id=nuevoLi;
            li.class = "list-group-item-info";
            li.style = "padding-bottom: 10px; color:darkgreen; font-weight: bold;";
            li.innerHTML = "<row><button type='button' onclick='eliminar(this)' class='btn btn-outline-danger' style='margin-right: 20px ;'>Eliminar</button>" + nuevoLi + "<input type='text' id='" + index + "' name='" + index + "' disabled value='" + nuevoLi + "' class='form-control'></row>";
            document.getElementById(lista).appendChild(li);
        }
    }
}

/**
 * Funcion que busca si existe ya el <li> dentrol del <ul>
 * Devuelve true si no existe.
 */
function find_li(contenido, lista)
{
    var el = document.getElementById(lista).getElementsByTagName("li");
    for (var i=0; i<el.length; i++)
    {
        console.log("el[" + i + "].innerHTML", el[i].id);
        console.log("contenido", contenido);
        console.log("Comparando li: ", "el[" + i + "].innerHTML == " + contenido);
        if(el[i].id==contenido)
            return 0;
    }
    return el.length + 1;
}

/**
 * Funcion para eliminar los elementos
 * Tiene que recibir el elemento pulsado
 */
function eliminar(elemento)
{
    var id=elemento.parentNode.getAttribute("id");
    node=document.getElementById(id);
    node.parentNode.removeChild(node);
}

function  validaList(){
    var elt = document.getElementById("listaTelefonos").getElementsByTagName("li");
    if(elt.length == 0){alert("Porfavor agrega uno o mas telefonos");return false;}
    var ele = document.getElementById("listaEmails").getElementsByTagName("li");
    if(ele.length == 0){alert("Porfavor agrega uno o mas emails");return false;}
    //return false;
    var telefonos = [];
    var emails = [];
    for (var i = 0; i < elt.length; i++){
        t = {
            "tel": elt[i].id,
        }
        telefonos.push(t);
    }
    for (var i = 0; i < ele.length; i++){
        t = {
            "email": ele[i].id,
        }
        emails.push(t);
    }
    console.log("telefonos", telefonos);
    console.log("emails", emails);
    var tel = document.getElementById('telefonos');
    var email = document.getElementById('correos');
    tel.value = JSON.stringify(telefonos);
    email.value = JSON.stringify(emails);
    return true;

    /*Dejar los arreglos de Telefonos e Emails del lado del servidor como variable de session*/
    /*$.get(this.app + "/register/valida/" + JSON.stringify(telefonos) + "/" + JSON.stringify(emails), function(d){
        //console.log(d);
        return true;
    });*/
    //return false;
}
function productosAjax(url){
    var b = $("#buscarP").val();
    $.post(url,{buscar:b},function(data){
        $("#productosCompra").html(data);
    });
}
function ajaxNuevoTelefono(url) {
    if(!validarCampo($("#telefononuevo").val(), "telefono")) {console.log("Escribe un numero telefonico valido"); return;}
    console.log("Holi", url);
    $.post(url, {telefononuevo: $("#telefononuevo").val(), _token: token}, function(data){
        if(!data.Error){
            cargarTelefonos(data.telefonos);
            $("#modal-telefono").modal("hide");
        }else{
            console.log(data.msj);
            alert(data.msj);
        }
    });
}
function ajaxNuevoEmail(url) {
    if(!validarCampo($("#emailnuevo").val(), "email")) {console.log("Escribe un email valido"); return;}
    console.log("Holi", url);
    $.post(url, {emailnuevo: $("#emailnuevo").val(), _token: token}, function(data){
        console.log(data);
        if(!data.Error){
            cargarEmails(data.emails);
            $("#modal-correo").modal("hide");
        }else{
            console.log(data.msj);
            alert(data.msj);
        }
    });
}

function cargarTelefonos(data){
    //console.log(data);
    var select = document.getElementById("telefonos");
    $("#telefonos").empty();
    if(data.length != 0){
        for (value in data) {
            var option = document.createElement("option");
            option.text = data[value].numero;
            option.value = (data[value].id);
            select.add(option);
        }
    }else {
        var option = document.createElement("option");
        option.text = "No hay nigun Telefono";
        option.value = 0;
        select.add(option);
    }
}
function cargarEmails(data){
    //console.log(data);
    var select = document.getElementById("emails");
    $("#emails").empty();
    if(data.length != 0){
        for (value in data) {
            var option = document.createElement("option");
            option.text = data[value].email;
            option.value = (data[value].id);
            select.add(option);
        }
    }else {
        var option = document.createElement("option");
        option.text = "No hay ningun Email";
        option.value = 0;
        select.add(option);
    }
}

function vrificarDatoFiscal(url){
    $.get(url, {}, function (data) {
        console.log(url);
        if(data.bnd){
            console.log(data);
            $("#idVenta").val(data.idVenta);
            $("#accion").val(data.accion);
            cargarEmails(data.emails);
            $("#modal-correo-nuevo").modal("show");
        }else{
            console.log(data);
            document.location.href = url;
        }

    })
}

function ajaxEmails(url){
    $.post(url, {}, function (data) {
        cargarEmails(data);
    })
}

function ajaxTelefonos(url){
    $.post(url, {}, function (data) {
        cargarTelefonos(data);
    })
}
var productos;
function ajaxProductos(url){
    $.post(url, {}, function(data){
            var select = document.getElementsByName("selectProductos")[0];
            $("#selectProductos").empty();
            productos = data.productos;
            for (value in productos) {
                var option = document.createElement("option");
                option.text = data.productos[value].nombre;
                option.value = (data.productos[value].id);
                //option.val(data.productos[value].id);
                select.add(option);
                console.log(value);
            }rellenarPrecio();
        console.log(select);
        console.log(data.productos);

    });
}
var pro;
function rellenarPrecio(){
    pro = null;
    console.log("Holii");
    var selected = $("#selectProductos").val();
    for(let prod of productos){
        if(prod.id == selected) {
            pro = prod;
            $("#precioO").val(prod.precio);
            $("#stock").val(prod.stock);
            //Falta la imagen
            var img = document.getElementById("imgSalidaPromo");
            img.src = (prod.imagen != null) ? app + "/" + prod.imagen.replace('public', 'storage'): app + "/storage/sinimagen.png";
            console.log("Rutaa IMG: ", (prod.imagen != null) ? app + "/" + prod.imagen.replace('public', 'storage'): app + "/storage/sinimagen.png");
            calcularPromocionProducto();

            break;
        }
    }
}
function calcularPromocionProducto(){
    var porcentaje =  ($("#porcentaje").val() == "") ? 0 : $("#porcentaje").val();
    var precio = $("#precioO").val();
    try{
        porcentaje = parseInt(porcentaje);
        precio = parseFloat(precio);
        $("#precioF").val(precio - ((precio * porcentaje) / 100));
        console.log(precio - ((precio * porcentaje) / 100));
    }catch(e){
        alert("Error al calcular el precio final");
    }
}
var productosPromocion = [];
function agregarFila(){
    if($("#porcentaje").val() == ""){
        alert("Porfavor agrega un descuento al producto seleccionado");
        return;
    }
    if(parseInt($("#porcentaje").val()) <= 0){
        alert("El descuento debera ser mayor a cero :)");
        return;
    }
    if(parseInt($("#porcentaje").val()) > 100){
        alert("El descuento debera ser menor a 100 :)");
        return;
    }

    p = {
        producto: pro.id,
        porcentaje: $("#porcentaje").val(),
    };

    //console.log("index", productosPromocion.index(pro.id));
    //console.log("index", productosPromocion.);
    console.log("aaaaproductosPromocion", productosPromocion);

    const resultado = productosPromocion.findIndex(existeItem);
    //console.log(productosPromocion.findIndex(existeItem));
    console.log(resultado);
    if(resultado != -1) {
        eliminarFila(pro.id);
    }

    addFila();
    productosPromocion.push(p);
    console.log("productosPromocion", productosPromocion);
}
function existeItem(element) {
    console.log(element.producto + " == " +pro.id );
    return element.producto == pro.id;
}
function eliminarItem(holi){
    return holi.producto == pro.id;
}

function  rellenaProductos(){
    console.log(productosPromocion);
    console.log(productosPromocion.values());
    if(productosPromocion.length <= 0){
        alert("Error, Porfavor agregue por lo menos un producto a la promocion");
        return false
    }
    var prod = document.getElementById('productos');
    prod.value = JSON.stringify(productosPromocion);
    return true;
}

function addFila(){
    var tabla = document.getElementById("tabla");
    var fila = (tabla.rows.length + 1);
    tabla.insertRow(-1).innerHTML = '' +
        '<td>'+ pro.nombre +'</td>' +
        '<td>'+ pro.stock +'</td>' +
        '<td>'+ pro.precio +'</td>' +
        '<td>'+ $("#porcentaje").val() +'</td>' +
        '<td>'+ $("#precioF").val() +'</td>' +
        '<td><button type="button" class="btn btn-outline-danger" onclick="eliminarFila('+ pro.id +')">Eliminar</button></td>' +
        '';
    tabla.rows.item(fila - 1).setAttribute("id", "fila-" + pro.id);
}
function eliminarFila(index) {
    $("#fila-" + index).remove();
    const resultado = productosPromocion.findIndex(eliminarItem);
    console.log(resultado);
    if(resultado != -1) {
        productosPromocion.splice(resultado, 1);
    }
}
var idProducto = 0;
var prom = null;
function abrirModalCompras(p, promocion, porcentaje = 0){
    $("#nombre").val(p.nombre);
    $("#cantidad").val(1);

    //$("#id-prod").val(p.idProd);
    idProducto = p.id;
    console.log(promocion)

    if(promocion != undefined){
        $("#tituloPromo").text("Promocion " + promocion.nombre);
        $("#periodo").text("Desde : " + promocion.fehcainicio + " hasta " + promocion.fechafinal);
        $("#precioOriginal").val(p.precio);
        $("#porcentaje").val(porcentaje + "%");
        $("#promocion").css("display", "block");
        $("#descuento").css("display", "block");
        $("#normal").css("display", "none");
        var desc = (porcentaje * p.precio) / 100;

        $("#precioFinal").val(p.precio - desc);
        $("#total").val(p.precio - desc);
        prom = promocion;
    }else{
        $("#promocion").css("display", "none");
        $("#descuento").css("display", "none");
        $("#normal").css("display", "block");
        $("#precio").val(p.precio);
        $("#total").val(p.precio * 1);
        prom = null;
    }
}

function calculaTotal(){
    var cant = $("#cantidad").val();
    var precio = (prom != null) ? $("#precioFinal").val(): $("#precio").val();
    try{
        cant = parseInt(cant);
        precio = parseFloat(precio);
        //console.log(cant);
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

function comprar(){
    var cantidad = $("#cantidad").val();
    $.post(app + "/ajax/compras/carrito",{cantidad:cantidad,id:idProducto, idPromocion: (prom != null) ? prom.id: null},function(d){
        //console.log(d);
        if(d.ok){

            //$('#modal').modal().hide();
            $("#badge").html(d.cant);
            $('#modal-compras').modal('toggle')
            //$("#modal-compras .close").click()

        }else{
            alert(d.msj);
        }
    });
}

function guardarCompra(){
    $("#aceptar").html("Procesando Compra...");
    $("#aceptar").attr("disabled",true);
    $("#cancelar").attr("disabled",true);

    $.post(app + "/ajax/compras/store",{},function(d){
        console.log(d);
        if(d.respuesta){
            if(d.msj != "")
                alert(d.msj);
            document.location.href = app + "/compras/cliente";
        }else{
            $("#aceptar").html("Comprar");
            $("#aceptar").removeAttr("disabled");
            $("#cancelar").removeAttr("disabled");
            alert(d.msj);
        }
    });
}


function eliminarProdCompras(id){
    var c = confirm("desea confirmas la eliminacion?");

    if(c){
        $.get(app + "/ajax/compras/eliminar/producto/" + id , function (d) {
            document.location.href = app + "/carrito/compras"
        });
    }
}

function cancelarCompras(){
    var c = confirm("Seguro de Eliminar la compra?");

    if(c){
        $.get(app + "/ajax/carrito/cancelar", function (d) {
            document.location.href = app + "/carrito/compras"
        });
    }
}


/****Metodos agregados*****/
function eliminarProducto(p){
    p = JSON.parse(p);
    var opcion = confirm("¿Desea eliminar el producto " + p.nombre + " ?");
    return opcion;
}

function resetearCamposModal(bnd=false){
    if(bnd){
        $("#nombreE").val("");
        $("#descripcionE").val("");
        $("#stockE").val("");
        $("#precioE").val("");
        var img = document.getElementById("imgSalidaE");
        img.src = "";
        var input = $("#imagenPE");
        input.replaceWith(input.val('').clone(true));
    }else{
        $("#nombre").val("");
        $("#descripcion").val("");
        $("#stock").val("");
        $("#precio").val("");
        var img = document.getElementById("imgSalida");
        img.src = "";
        var input = $("#imagenP");
        input.replaceWith(input.val('').clone(true));
    }

}
function prueba(){
    var input = $("#imagenP");
    console.log("Valor del inpur File : ",input.val());
    return false;
}