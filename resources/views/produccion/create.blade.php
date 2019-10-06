@extends("plantilla.template")
@section("contenido1")
    @include("plantilla.bordeSCM")

    <div class="container mb-5 mt-5">
        <h1 class="text-center">Producción del Día</h1>



        <div class="mb-5">

            <form class="" method="POST" action="{{ route('produccion.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="mb-5">
                    <h3>Producto : </h3>
                    <select id="producto" name="producto" class="form-control" onchange="cambiaSelectProductos()">
                        @foreach($productos as $p)
                            <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <h3>Metodos de Fabrica : </h3>
                    <select id="metodo" name="metodo" class="form-control" onchange="onChangeMetodo()" >

                    </select>
                </div>

                <div id="materiasEnOcupa" class="mb-5">
                    @include("produccion.materiasEnOcupa")
                </div>

                <div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
                    <label for="cantidad" class="h4 text-dark">Cantidad Fabricado del producto:</label>

                    <div class="">
                        <input id="cantidad" type="number" class="form-control" name="cantidad" value="{{ old('cantidad') }}" required autofocus>

                        @if ($errors->has('cantidad'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cantidad') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="">
                        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
                    </div>
                </div>



            </form>
        </div>









@endsection

@section("script")
    <script type="text/javascript">

        window.onload = function() {
            cambiaSelectProductos();
        }


    </script>
@endsection