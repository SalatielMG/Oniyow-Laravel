@extends("plantilla.template")
@section("contenido1")
    @include("plantilla.borde")
    @include("factura.modalFactura")
    <div class="services">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title">
                        <h2>Compras realizadas</h2>
                        <!--h1>RanGO. We take care of your business</h1>
                        <span>Explore our services</span-->
                    </div>
                </div>
            </div>
            <br>
    @empty($ventas)
        <div class="alert alert-warning" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            No ha realizado compras
        </div>
    @else
        <div id="accordion">
            @foreach($ventas as $v)
                <div class="card">
                    <div class="card-header" id="f-{{ $v->id }}">
                        <h5 class="mb-0">
                            <button class="btn btn-info" data-toggle="collapse" data-target="#collapse{{ $v->id }}" aria-expanded="false" aria-controls="collapse{{ $v->id }}">
                                Venta {{ $v -> id }} - Fecha: {{ date("d-m-Y",strtotime($v -> created_at) )}}
                            </button>
                            <div class="btn-group float-right">
                                <a class="btn btn-outline-success"  onclick="vrificarDatoFiscal('{{ route('verificar.DatoFiscal', ["idVenta" => $v -> id, "accion" => 0])}}')">FACTURA</a>
                                <a class="btn btn-outline-success  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" onclick="vrificarDatoFiscal('{{ route('verificar.DatoFiscal', ["idVenta" => $v -> id, "accion" => 1]) }}')">Imprimir PDF</a>
                                    <a class="dropdown-item" onclick="vrificarDatoFiscal('{{ route('verificar.DatoFiscal', ["idVenta" => $v -> id, "accion" => 2]) }}')">Descargar PDF</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" onclick="vrificarDatoFiscal('{{ route('verificar.DatoFiscal', ["idVenta" => $v -> id, "accion" => 3]) }}')">Enviar Correo</a>
                                </div>
                            </div>
                        </h5>
                    </div>

                    <div id="collapse{{ $v->id }}" class="collapse" aria-labelledby="heading{{ $v->id }}" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Precio Original</th>
                                    <th>Cantidad</th>
                                    <th>Promocion</th>
                                    <th>SubTotal</th>
                                </tr>
                                @php
                                    $x = 1;
                                    $total = 0;

                                @endphp
                                @foreach($v->productos as $vp)
                                    @php
                                        $precio = $vp -> pivot -> precio - (($vp -> pivot -> precio * $vp -> pivot -> porcentaje) / 100);
                                        $subtotal = $vp -> pivot -> cantidad * $precio;
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $x++ }}</td>
                                        <td>{{ $vp -> nombre }}</td>
                                        <td>${{ number_format($vp -> pivot -> precio,2,".","") }}</td>
                                        <td>{{ $vp -> pivot -> cantidad }}</td>
                                        <td>{{ ($vp -> pivot -> porcentaje == 0) ? "NA": $vp -> pivot -> porcentaje . "%" }}</td>
                                        <td>${{ number_format($subtotal,2,".","") }} </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" align="right"><strong>Total</strong></td>
                                    <td>${{ number_format($total,2,".","") }} </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @endempty
        </div>
    </div>
@endsection