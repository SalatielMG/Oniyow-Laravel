@extends("plantilla.template")
@section("contenido1")
    @include("plantilla.bordeSCM")
    @include("provisiona.modalCompra")

    <div class="container mb-5 mt-5">

        <div class="mb-5">
            <h2 class="card-title">Proveedor a comprar: </h2>
            <select id="proveedor" name="proveedor" class="form-control h2">
                @foreach($proveedores as $p)
                    <option value="{{ $p->datos->id }}">{{ $p->nombrerazonsocial }} ___ {{ $p->representantelegal }} ___ {{ $p->datos->domicilioparticular }}</option>
                @endforeach
            </select>
        </div>


        <div id="materiasCompradas" class=" mb-5">
            @include("provisiona.materiasComprar")
        </div>



        <div class=" mb-5">
            <h2>Elija las Materias que comprara</h2>
            <div class="input-group mb-5">
                <div class="input-group-prepend">
                    <button type="button" class="btn btn-success btn-lg" style="background: #6610f2"
                            onclick="materias('{{ route('materias.search') }}')" id="button-addon1">Buscar</button>
                </div>
                <input type="text" class="form-control" id="buscar" name="buscar" placeholder="Buscar Materia o insumo" onkeyup="materias('{{ route('materias.search') }}')" aria-describedby="button-addon1">

            </div>
            <div id="materiasAjax">

            </div>
        </div>

    </div>


@endsection

@section("script")
    <script type="text/javascript">
        $(document).ready(function(){
            materias('{{ route("materias.search") }}');
        });
    </script>
@endsection