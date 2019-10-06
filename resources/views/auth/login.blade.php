@extends('plantilla.template')

@section('contenido1')
        @include("plantilla.borde")
        @include("plantilla.mens")
        <div class="card ventana-2" style="margin-top: 100px">
            <div class="card-header" style="text-align: center; font-weight: bold; font-size: 20px">
                Login
            </div>
            <div class="card-body">

                <form class="" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                        <label for="usuario" class="control-label">Usuario:</label>

                        <div class="">
                            <input id="usuario" type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" required autofocus>

                            @if ($errors->has('usuario'))
                                <span class="help-block">
                                <strong>{{ $errors->first('usuario') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Contraseña:</label>

                        <div class="">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="">
                            <button type="submit" class="btn btn-primary">
                                Entrar
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
 @endsection
@section("footer")
 @include("plantilla.footer")
@endsection
