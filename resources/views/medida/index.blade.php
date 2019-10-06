@extends("plantilla.template")

@section("contenido1")
    @include("plantilla.bordeSCM")
    @include("plantilla.mens")

    <?php $x = 1; ?>

    <div class="container mb-5 mt-5">


        <a class="btn btn-success btn-circle btn-xl" href="#" data-toggle="modal" data-target="#modal-medida" >
            <i class="fa fa-plus centrado" aria-hidden="true"></i>
        </a>

        <h1 class="text-center">Unidades de Medida</h1>

        <table class="table table-striped">

         <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
            @foreach($medida as $m)
                <tr>
                    <td> {{ $x++ }}</td>
                    <td>{{ $m->medida }}</td>
                    <td>
                        <!-- Example single danger button -->
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opción
                            </button>
                            <div class="dropdown-menu bg-dark">
                                <a class="dropdown-item text-light" data-toggle="modal" data-target="#modal-medidaEdit" href="#" onclick="modalUpdateMedida({{ json_encode($m) }})">Editar</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route("medida.destroy",$m->id) }}" method="POST">
                                    {{ csrf_field() }}{!! method_field("DELETE") !!}

                                    <button type="submit" class="dropdown-item text-light">Eliminar</button>
                                </form>
                            </div>
                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>


    @include("medida.modal")
    @include("medida.modalEdit")
@endsection