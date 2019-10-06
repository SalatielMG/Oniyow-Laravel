<h3 for="">Materias ocupados para la fabricacion  </h3>

@if(!empty($materiasOcupa))
    <label>Se han creado {{$totalProducciones}} produccion(es) con este método</label>

    @php
        $x = 1;
        $total = 0;
    @endphp
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Materia</th>
            <th>Cantidad
                <div class="float-right">
                    <button type="button" class="btn btn-outline-danger" onclick="eliminarMetodo('{{ $materiasOcupa[0]->id }}','{{ $totalProducciones }}')">Eliminar</button>
                </div>
            </th>

        </tr>
        </thead>

        @foreach($materiasOcupa[0]->materias as $c)
            @php
                //$st = $c["cantidad"] * $c["precio"];
                //$total += $st;
            @endphp
            <tr >
                <td>{{ $x++ }}</td>
                <td>{{ $c["nombre"] }}</td>
                <td>{{ $c->pivot->cantidad}}</td>

            </tr>
        @endforeach

    </table>
@else
    <div class="alert alert-dark" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
        Elija un proceso de produccion
    </div>
@endif