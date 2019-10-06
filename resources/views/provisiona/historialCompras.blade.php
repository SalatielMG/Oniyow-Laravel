@extends("plantilla.template")
@section("contenido1")
    @include("plantilla.bordeSCM")

    <div class="container mb-5 mt-5">
    <h1>Compras Realizadas al proveedor</h1>
    @empty($provisiona)
        <div class="alert alert-warning" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            No ha realizado compras a ningun proveedor
        </div>
    @else
        <div id="accordion">
            @php $i = 0; @endphp
            @foreach($provisiona as $v)
                @php $i ++; @endphp
                <div class="card">
                    <div class="card-header" id="f-{{ $v->id }}">
                            <table class="table table-hover" >
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Compra  {{ $i }} </th>
                                        <th>Fecha {{ date("d-m-Y",strtotime($v->created_at) )}} </th>
                                        <th>
                                            <a class="btn btn-outline-info btn-lg" data-toggle="collapse" data-target="#collapse{{ $v->id }}" aria-expanded="false" aria-controls="collapse{{ $v->id }}">Ver</a>
                                        </th>
                                        <th>
                                            <a class="btn btn-outline-danger" onclick="deleteProvisiona( {{ $v->id }} )">Eliminar</a>
                                        </th>
                                    </tr>
                                </thead>
                            </table>


                    </div>

                    <div id="collapse{{ $v->id }}" class="collapse" aria-labelledby="heading{{ $v->id }}" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>SubTotal</th>
                                </tr>
                                @php
                                    $x = 1;
                                    $total = 0;

                                @endphp
                                @foreach($v->materias as $vp)
                                    @php
                                        $subtotal = $vp->pivot->cantidad * $vp->pivot->precio;
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $x++ }}</td>
                                        <td>{{ $vp->nombre }}</td>
                                        <td>{{ $vp->pivot->cantidad }}</td>
                                        <td>${{ number_format($vp->pivot->precio,2,".","") }}</td>
                                        <td>${{ number_format($subtotal,2,".","") }} </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right"><strong>Total</strong></td>
                                    <td>${{ number_format($total,2,".","") }} </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
    @endempty
@endsection