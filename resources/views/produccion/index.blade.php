@extends("plantilla.template")
@section("contenido1")
    @include("plantilla.bordeSCM")
    <?php $x = 1;  ?>

    <div class="container mb-5 mt-5">


    <div >
        <h2 class="text-center">Productos</h2>
            <div class="float-right">
                <a href="{{ route("pdf.produccion") }}" class="btn btn-outline-info">PDF</a>

            </div>
        </div>

    <div class="">
        @foreach($productos as $p)
            <div class="mb-3 mt-5">
                <table class="table ">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Serie</th>
                        <th></th>
                        <th>Descripcion</th>
                        <th>Existencia</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr >
                        <td> {{ $x++ }} </td>
                        <td> {{$p->id}} </td>
                        <td> {{$p->nombre}} </td>
                        <td> {{$p->descripcion}} </td>
                        <td> {{$p->stock}} </td>
                        <td> <button class="btn btn-outline-dark" data-toggle="collapse" data-target="#cp{{$p->id}}" aria-expanded="false" aria-controls="collapseExample"  >
                                Ver
                            </button></td>
                    </tr>
                    </tbody>
                </table>

            </div>


`
            <div class="collapse" id="cp{{$p->id}}">
                <h3 class="btn btn-dark">Métodos de fabrica = {{count($p->metodofabrica)}}</h3>

                <div class="row">
                    <div class="col-6">
                    @foreach( $p->metodofabrica as $mf)


                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"> {{$mf->nombre  }}</h3>
                                    <p class="card-text">Descipcion: {{$mf->descripcion }}</p>
                                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                                    <button class="btn btn-outline-success" data-toggle="collapse" data-target="#mf{{$mf->id}}" onclick="removeShowMet('mf'+'{{$mf->id}}')">
                                        ver - {{count($mf->produccion)}} Producción(es)
                                    </button>
                                </div>
                            </div>

                    @endforeach
                    </div>

                    <div class="col-6">

                            <button class="btn btn-dark">Producciones</button>
                            @foreach( $p->metodofabrica as $mf)
                            <div class="collapse" id="mf{{$mf->id}}">
                                @foreach( $mf->produccion as $pro)

                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Cantidad Fabricado: {{$pro->cantidadfabricado }}</h3>
                                            <p class="card-text">{{$pro->created_at  }}</p>
                                            <p class="card-text"></p>
                                            <button class="btn btn-outline-danger" onclick="borrarProduccion('{{$pro->id}}')">Delete</button>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                            @endforeach

                    </div>

                </div>


            </div>

        @endforeach
    </div>



    </div>




@endsection