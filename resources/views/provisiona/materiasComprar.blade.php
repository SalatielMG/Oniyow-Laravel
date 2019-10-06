<h2 class="">Materias a comprar: </h2>

@if(!empty($compraMaterias))
    @php
        $x = 1;
        $total = 0;
    @endphp
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Materia</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>SubTotal</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        @foreach($compraMaterias as $c)
            @php
                $st = $c["cantidad"] * $c["precio"];
                $total += $st;
            @endphp
            <tr>
                <td>{{ $x++ }}</td>
                <td>{{ $c["nombre"] }}</td>
                <td>{{ $c["cantidad"] }}</td>
                <td>{{ $c["precio"] }}</td>
                <td>{{ $st }}</td>
                <td></td>
                <td align="right"><a href="#" class="btn btn-warning" onclick="eliminarMateriaDentroProvisiona({{ $c["id"] }})">Eliminar</a></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" ><strong>Total</strong></td>
            <td>${{ number_format($total,2,".","") }} </td>
            <td>
                <div class="">
                    <button  href="#" id="aceptar" onclick="guardarCompraProvisiona()" class="newsletter button newsletter_submit_button trans_200" >
                        Comprar
                    </button>
                </div>
            </td>
            <td align="right">
                <button href="#" id="cancelar" onclick="cancelarCompraProvisiona()" class="btn btn-dark">Cancelar</button>
            </td>
        </tr>
    </table>
@else
    <div class="alert alert-dark" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
        No hay nada comprado
    </div>
@endif