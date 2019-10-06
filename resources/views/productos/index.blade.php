@extends("plantilla.template")
@section("encabezados")
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/services_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/services_responsive.css') }}">
@endsection
@section("contenido1")
    @include("plantilla.borde")
    @include("productos.modalCreateProducto")
    @include("productos.modalEditProducto")
    <div class="image_boxes" style="margin-top: 0px;">
        @include("plantilla.mens")
        <div class="container">
            <h1 style="text-align: center; margin-bottom: 50px"> Productos</h1>
            @empty($productos)
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    No existe ninguna producto Actualmente
                </div>
            @else
                <div class="row">
                @foreach($productos as $vp)
                    <div class="col-lg-4 image_box_col" style="margin-bottom: 20px; margin-left: 10px;">
                        <div class="card trans_300">
                            <img class="card-img-top" src="{{ ($vp -> imagen != null) ? asset(Storage::url($vp -> imagen)) : asset(Storage::url("sinimagen.png"))}}" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="card-title"><strong>{{$vp -> nombre}}</strong></h3>
                                <p class="card-text">

                                    Descripcion: <b>{{ $vp -> descripcion }}</b> <br>
                                    Existencia: <b>{{ $vp -> stock }}</b> <br>
                                    Precio Original: <b>{{ $vp -> precio }}</b> <br>
                                </p>

                                <a href="#" class="card-link" >Ver mas</a>

                            </div>
                        </div>
                    </div>
                    <div style="margin-left: -40px;">
                        <div class="row" style="margin-bottom: 5px">
                            <button class="btn btn-outline-success" style="width: 40px; height:  40px; border-radius: 50%" data-toggle="modal" data-target="#modal-producto-edit" onclick="asignarCampos(JSON.stringify({{$vp}}), '{{ ($vp -> imagen != null) ? asset(Storage::url($vp -> imagen)) : null}}')">
                                <i class="fa fa-edit" aria-hidden="true" style="font-size: 15px; color: #fffad3;"></i>
                            </button>
                        </div>
                        <div class="row" >
                            <form action="{{ route("producto.destroy",$vp -> id) }}" method="POST" onsubmit="return eliminarProducto(JSON.stringify({{$vp}}))">
                                {{ csrf_field() }}{!! method_field("DELETE") !!}

                                <button  type="submit" class="btn btn-outline-danger" style="width: 40px; height:  40px; border-radius: 50%">
                                    <i class="fa fa-trash" aria-hidden="true" style="font-size: 15px; color: #ffe760;"></i>

                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
                </div>
            @endif
        </div>
        <div class="fixed-bottom float-right ">
            <!--a href="/maquinitasCakeP/cajas/add" class="btn btn-outline-info agregar" style="height: 50px; width: 50px; border-radius: 50%; "></a-->

            <button class="btn btn-outline-info" style="border-radius: 50%; height: 60px; width: 60px;  float: right; margin-bottom: 30px; margin-right: 30px; align-items: center; vertical-align: center" data-toggle="modal" data-target="#modal-producto-create" onclick="resetearCamposModal()">
                <i class="fa fa-plus" aria-hidden="true" style="font-size: 20px"></i>
            </button>
        </div>
    </div>

@endsection
@section("script")
    <script>
        //$(window).load(function(){
        function asignarCampos(p, ruta=""){
            p = JSON.parse(p);
            resetearCamposModal(true);
            $("#idP").val(p.id);
            $("#nombreE").val(p.nombre);
            $("#descripcionE").val(p.descripcion);
            $("#stockE").val(p.stock);
            $("#precioE").val(p.precio);
            var img = document.getElementById("imgSalidaE");
            //var input = $("#imagenPE");
            if(p.imagen != null){
                img.src = ruta;
                //input.replaceWith(input.val(ruta).clone(true));
            }
        }

        $(function() {
            $('#imagenP').change(function(e) {
                addImage(e);
            });

            function addImage(e){
                var file = e.target.files[0],
                    imageType = /image.*/;

                if (!file.type.match(imageType))
                    return;

                var reader = new FileReader();
                reader.onload = fileOnload;
                reader.readAsDataURL(file);
            }

            function fileOnload(e) {
                var result=e.target.result;
                $('#imgSalida').attr("src",result);
            }
        });
        $(function() {
            $('#imagenPE').change(function(e) {
                addImage(e);
            });

            function addImage(e){
                var file = e.target.files[0],
                    imageType = /image.*/;

                if (!file.type.match(imageType))
                    return;

                var reader = new FileReader();
                reader.onload = fileOnload;
                reader.readAsDataURL(file);
            }

            function fileOnload(e) {
                var result=e.target.result;
                $('#imgSalidaE').attr("src",result);
            }
        });
        //});
    </script>
@endsection

