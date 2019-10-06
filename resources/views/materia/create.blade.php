@extends("plantilla.template")
@section("contenido1")
    @include("plantilla.bordeSCM")
    <div class="container mb-5 mt-5">

        <div class="card-header">
            Nueva Materia o Insumo
        </div>
        <div class="card-body">

            <form class="" method="POST" action="{{ route('materia.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombre" class="control-label">Nombre:</label>

                    <div class="">
                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                        @if ($errors->has('nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                    <label for="descripcion" class="control-label">Descripcion:</label>

                    <div class="">
                        <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" required autofocus>

                        @if ($errors->has('descripcion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                    <label for="stock" class="control-label">Cantidad:</label>

                    <div class="">
                        <input id="stock" type="number" class="form-control" name="stock" value="{{ old('stock') }}" required autofocus>

                        @if ($errors->has('stock'))
                            <span class="help-block">
                                <strong>{{ $errors->first('stock') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group {{ $errors->has('unidadmedida') ? ' has-error' : '' }}">
                    <label for="unidadmedida" class="control-label">Unidad de Medida:</label>

                    <div class="input-group mb-5">
                        <select name="unidadmedida" id="unidadmedida" class="form-control newsletter">
                            @foreach ($unidadmedida as $um)
                                <option class="newsletter form-control" value="{{ $um->id }}">{{ $um->medida }}</option>
                            @endforeach()
                        </select>
                        @if ($errors->has('unidadmedida'))
                            <span class="help-block">
                                <strong>{{ $errors->first('unidadmedida') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('imagen') ? ' has-error' : '' }}">
                    <label for="imagen" class="control-label">Imagen:</label>

                    <div class="">
                        <input id="imagen" type="file" class="form-control" name="imagen" value="{{ old('imagen') }}">
                        @if ($errors->has('imagen'))
                            <span class="help-block">
                                <strong>{{ $errors->first('imagen') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group">
                    <div class="">
                        <button type="submit" class="btn btn-primary newsletter">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include("medida.modal")

@endsection