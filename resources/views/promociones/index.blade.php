@extends("plantilla.template")
@section("encabezados")
    <link href="{{ asset('css/gijgo.min.css') }}"  rel="stylesheet" type="text/css">
@endsection
@section("contenido1")
    @include("promociones.modalPromocion")
    @include("plantilla.borde")

    <div class="services">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title">
                        <h2>Lista de promociones</h2>
                        <!--h1>RanGO. We take care of your business</h1>
                        <span>Explore our services</span-->
                    </div>
                </div>
            </div>
            <br>


            @empty($promociones)
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    No exite ninguna promocion
                </div>
            @else
                <div id="accordion">
                    @foreach($promociones as $v)
                        <div class="card">
                            <div class="card-header" id="f-{{ $v->id }}">
                                <h5 class="mb-0">
                                    <button class="btn btn-info" data-toggle="collapse" data-target="#collapse{{ $v->id }}" aria-expanded="false" aria-controls="collapse{{ $v->id }}">
                                        Promocion {{ $v->id }}
                                    </button>
                                    <a class="btn btn-outline-secondary">{{$v -> nombre}} Desde el {{ $v -> fehcainicio }} al {{ $v -> fechafinal }}</a>

                                </h5>

                                <div id="collapse{{ $v->id }}" class="collapse" aria-labelledby="heading{{ $v->id }}" data-parent="#accordion">
                                    <div class="card-body">

                                        <div class="image_boxes">

                                            <div class="container">
                                                <div class="row">

                                                    @foreach($v -> productos as $vp)
                                                        <div class="col-lg-4 image_box_col" style="margin-bottom: 20px;">
                                                            <div class="card trans_300">
                                                                <img class="card-img-top" src="{{ ($vp -> imagen != null) ? asset(Storage::url($vp -> imagen)) : asset(Storage::url("sinimagen.png"))}}" alt="Card image cap">
                                                                <div class="card-body">
                                                                    <h3 class="card-title"><strong>{{$vp -> nombre}}</strong></h3>
                                                                    <p class="card-text">

                                                                        Descripcion: <b>{{ $vp -> descripcion }}</b> <br>
                                                                        Precio Original: <b>{{ $vp -> precio }}</b> <br>
                                                                        Descuento: <b>{{$vp -> pivot -> porcentaje}}</b> <br><br>
                                                                        Precio Final: <b>{{$vp -> precio - (($vp -> precio * $vp -> pivot -> porcentaje) / 100)}}</b> <br>
                                                                    </p>
                                                                    <!--a href="#" class="card-link">Ver mas</a-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endempty
        </div>
    </div>
    <div class="social-buttons fixed-bottom float-right " >
        <a href="#" class="social-buttons__button social-button social-button--snapchat" aria-label="SnapChat" data-toggle="modal" data-target="#modal-promocion" onclick="ajaxProductos('{{ route('promocion.productosAjax') }}')" style="float: right">
            <span class="social-button__inner">
             <i class="fa fa-plus-circle" style="zoom: 200%"></i>
            </span>
        </a>
    </div>

@endsection
@section("script")
    <script src="{{ asset('js/gijgo.min.js') }}" type="text/javascript"></script>
    <script>
        var fechaActual = new Date();
        var fechaInicio = null;
        var fechaFinal = null;
        fechaInicio = $('#datepicker').datepicker({
            useCurrent: false,
            format: 'yyyy/mm/dd',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            maxDate: function (){
                console.log("Fecha Inicio: MaxDate:=", fechaFinal.value())
                return fechaFinal.value();
                //fechaInicio.value(),
            },
            value:fechaActual.getFullYear() + "/"+ fechaActual.getMonth() + "/" + fechaActual.getDate(),
            //maxDate: fechaFinal.value(),
            close: function(data){
                //$("#datepicker2").datepicker( {minDate: fechaInicio.value()});

                //$("#datepicker2").datepicker( "option", "minDate", fechaInicio.value());
                //console.log("Holiiiiiii",data);
                //console.log("Fecha inicio:= ", fechaInicio.value());
            }

            /*onComplete: function(){
                console.log("Preuba1: ");
            },
            onClose: function( selectedDate ) {
                console.log("Fecha elegida 1: ");
                var date2 = $('#datepicker').datepicker('getDate');
                date2.setDate(date2.getDate()); //Aqui modificas los días como quieras
                $("#datepicker2").datepicker( "option", "minDate", date2);
                //Si quieres darle un nuevo valor al datepicker
                $("#datepicker2").datepicker( "option", "defaultDate", date2);
                console.log("Fecha elegida 1: ", date2);
            }*/
        });

        fechaFinal = $('#datepicker2').datepicker({
            useCurrent: false,
            format: 'yyyy/mm/dd',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: function (){
                //if()
                console.log("Fecha Final: MinDate:=", fechaInicio.value())
                return fechaInicio.value();
                //fechaInicio.value(),
            },
            //(date.getFullYear(), date.getMonth(), date.getDate());
            value:fechaActual.getFullYear() + "/"+ fechaActual.getMonth() + "/" + fechaActual.getDate(),
            close: function(data){
                //$("#datepicker").datepicker( {maxDate: fechaFinal.value()});

                //console.log("Holiiiiiii",data);
                //console.log("Fecha Final:= ", fechaFinal.value());
            }
        });
        $(function() {
            fechaInicio.close(function(){
                console.log("Holiffsfs");

            });

            /*$("#datepicker").on("dp.change",function (e){
                var fechaInicio = new Date(e.date);
                console.log("datepicker", e);
                $('#datepicker2').data("DatePicker").minDate(e.date);
                /*var maximaFechaFin = new Date();
                maximaFechaFin.setMinutes(1);

                $('#datepicker2').data("DatePicker").maxDate(maximaFechaFin);
            });

            $("#datepicker2").on("dp.change",function (e)
            {
                console.log("datepicker2", e);
                $('#datepicker').data("DatePicker").maxDate(e.date);
                /*var maximaFechaInicio = new Date();
                var minimoFechaInicio = new Date(maximaFechaInicio.getFullYear(), maximaFechaInicio.getMonth(), maximaFechaInicio.getDate() -92);

                $('#datepicker').data("DatePicker").minDate(minimoFechaInicio);
            });*/
        });



        function  rellenaProd(){
            var selectProductos = $("#selectProductos").val();
            var prod = document.getElementById('productos');
            prod.value = JSON.stringify(selectProductos);
            return true;

        }
    </script>
@endsection

