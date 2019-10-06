<label  class="h3" for="">Materias elegidos para la fabricacion: </label>

@if(!empty($materiasOcupa))

    @php
        $x = 1;
        $total = 0;
    @endphp
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Materia</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th></th>
            </tr>
        </thead>

        @foreach($materiasOcupa as $c)
            @php
                $st = $c["cantidad"] * $c["precio"];
                $total += $st;
            @endphp
            <tr >
                <td>{{ $x++ }}</td>
                <td>{{ $c["nombre"] }}</td>
                <td>{{ $c["cantidad"] }}</td>
                <td>{{ $c["precio"] }}</td>
                <td align="right"><a href="#" class="btn btn-warning" onclick="metodoEliminarMateria({{ $c["id"] }})">Eliminar</a></td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" align="right"><strong>Total: </strong></td>
            <td >{{ $total }} </td>
            <td>
                <div class="button icon_box_button trans_200">
                    <a href="#" id="aceptar" onclick="metodoGuardar()" class="trans_200">Crear</a>
                </div>
                <button href="#" id="cancelar" onclick="metodoCancelar()" class="btn btn-danger">Olvidar</button>
            </td>
        </tr>
    </table>
@else
    <div class="alert alert-dark" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
        Aun no hay productos seleccionados
    </div>
@endif