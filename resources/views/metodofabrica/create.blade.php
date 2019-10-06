@extends("plantilla.template")
@section("contenido1")
    @include("plantilla.bordeSCM")
    @include("metodofabrica.modalOcupa")

    <div class="container mb-5 mt-5">
        <h1 class="text-center">Nuevo Método de Fábrica</h1>
        <div class=" mb-5">
            <label class="h3">Producto : </label>
            <select id="producto" name="producto" class="form-control">
                @foreach($productos as $p)
                    <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">

            <form >

                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombreProceso"  class="h3">Nombre del Proceso:</label>

                    <div class="">
                        <input id="nombreProceso" type="text" class="form-control" name="nombreProceso" value="{{ old('nombreProceso') }}" required autofocus>

                        @if ($errors->has('nombreProceso'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombreProceso') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                    <label for="descripcion" class="control-label h3">Descripcion:</label>

                    <div class="">
                        <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>

                        @if ($errors->has('descripcion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


            </form>
        </div>


        <div id="materiasEnOcupa" class="mb-5">
            @include("metodofabrica.materiasEnOcupa")
        </div>



        <div class=" mb-5">
            <h2 class="">Seleccione las materias a ocupar</h2>
            <div class="input-group mb-5">
                <div class="input-group-prepend">
                    <button type="button" class="btn btn-success btn-lg" style="background: #6610f2"
                            onclick="materias('{{ route('metodo.materias.search') }}')" id="button-addon1">Buscar</button>
                </div>
                <input type="text" class="form-control" id="buscar" name="buscar" placeholder="Buscar Materia o insumo" onkeyup="materias('{{ route('metodo.materias.search') }}')" aria-describedby="button-addon1">

            </div>
            <div id="materiasAjax">

            </div>
        </div>

    </div>


@endsection

@section("script")
    <script type="text/javascript">
        $(document).ready(function(){
            materias('{{ route("metodo.materias.search") }}');
        });
    </script>
@endsection