@extends("plantilla.template")

@section("contenido1")
    @include("plantilla.bordeSCM")
    <?php $x = 1; ?>

    <div class="container mb-5 mt-5">


        <a href="{{ route("materia.create") }}" class="btn btn-danger " style="float: left">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>


        @include("plantilla.mens")

        <h1 class="text-center">Materias o Insumos</h1>

        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Existencia</th>
                <th>Unidad de Medida</th>
                <th>Imagen</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($materias as $m)
                <tr>
                    <td> {{ $x++ }}</td>
                    <td>{{ $m->nombre }}</td>
                    <td>{{ $m->descripcion }}</td>
                    <td>{{ $m->stock }}</td>
                    <td>{{ $m->unidad->medida }}</td>
                    <td>
                        <img src="{{ asset(Storage::url($m->imagen)) }}" width="100" alt="">

                    </td>
                    <td>
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opción
                            </button>
                            <div class="dropdown-menu bg-dark">
                                <a class="dropdown-item text-light" href="{{ route("materia.show",$m->id) }}">Mostrar</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-light" href="{{ route('materia.edit',$m->id) }}">Editar</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route("materia.destroy",$m->id) }}" method="POST">
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



@endsection