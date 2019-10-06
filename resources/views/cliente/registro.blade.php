@extends('plantilla.template')

@section('contenido1')
    @include("plantilla.borde")
    <div class="card ventana-2" style="margin-top: 100px">
        <div class="card-header" style="text-align: center; font-weight: bold; font-size: 20px">
            Registro {{$cliente}}
        </div>
        <div class="card-body">
            <form class="" method="POST" action="{{ route('register', ['tipo' => $cliente]) }}" onsubmit="return validaList()">
                {{ csrf_field() }}
                <input type="hidden" name="telefonos" id="telefonos">
                <input type="hidden" name="correos" id="correos">
                @if($cliente === 'empresa')
                    <div class="form-group{{ $errors->has('razonSocial') ? ' has-error' : '' }}">
                        <label for="razonSocial" class="control-label">Razon Social:</label>

                        <div class="">
                            <input id="razonSocial" type="text" class="form-control" name="razonSocial" value="{{ old('razonSocial') }}" required autofocus>

                            @if ($errors->has('razonSocial'))
                                <span class="help-block">
                                <strong>{{ $errors->first('razonSocial') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('representanteLegal') ? ' has-error' : '' }}">
                        <label for="representanteLegal" class="control-label">Representante Legal:</label>

                        <div class="">
                            <input id="representanteLegal" type="text" class="form-control" name="representanteLegal" value="{{ old('representanteLegal') }}" required autofocus>

                            @if ($errors->has('representanteLegal'))
                                <span class="help-block">
                                <strong>{{ $errors->first('representanteLegal') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('sitioWeb') ? ' has-error' : '' }}">
                        <label for="sitioWeb" class="control-label">Sitio Web:</label>

                        <div class="">
                            <input id="sitioWeb" type="text" class="form-control" name="sitioWeb" value="{{ old('sitioWeb') }}" autofocus>

                            @if ($errors->has('sitioWeb'))
                                <span class="help-block">
                                <strong>{{ $errors->first('sitioWeb') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                @else
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
                    <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                        <label for="apellido" class="control-label">Apellido:</label>

                        <div class="">
                            <input id="apellido" type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" required autofocus>

                            @if ($errors->has('apellido'))
                                <span class="help-block">
                                <strong>{{ $errors->first('apellido') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="form-group{{ $errors->has('domicilioParticular') ? ' has-error' : '' }}">
                    <label for="domicilioParticular" class="control-label">Domicilio Particular:</label>

                    <div class="">
                        <input id="domicilioParticular" type="text" class="form-control" name="domicilioParticular" value="{{ old('domicilioParticular') }}" required autofocus>

                        @if ($errors->has('domicilioParticular'))
                            <span class="help-block">
                                <strong>{{ $errors->first('domicilioParticular') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors -> has('telefonos') ? 'has-error' : '' }}">
                    <label for="telefonos" class="control-label"><strong>Telefonos:</strong></label>
                    <div class="">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" id="nuevo_telefono" autofocus placeholder="9711207450" class="form-control">

                            </div>
                            <div class="col-2">
                                <button type="button" onclick="add_li('telefono')" class="btn btn-success">Agregar</button>
                            </div>
                        </div>
                        <br>
                        <div class="list-group">
                            <ul id="listaTelefonos" name="listaTelefonos" class="form-control">
                                <!--li class="list-group-item-info">Holi
                                </li-->
                            </ul>
                        </div>
                        @if ($errors->has('telefonos'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telefonos') }}</strong>
                            </span>
                        @endif

                    </div>
                </div>

                <div class="form-group{{ $errors -> has('nuevo_email') ? 'has-error' : '' }}">
                    <label for="correos" class="control-label"><strong>Emails:</strong></label>
                    <div class="">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" id="nuevo_email" autofocus placeholder="algo@algo.algo" class="form-control">
                            </div>
                            <div class="col-2">
                                <button type="button" onclick="add_li('email')" class="btn btn-success">Agregar</button>
                            </div>
                        </div>
                        <br>
                        <div class="list-group">
                            <ul id="listaEmails" class="list-group-flush">
                                <!--li class="list-group-item-info">Holi
                                </li-->
                            </ul>
                        </div>
                        @if ($errors->has('correos'))
                            <span class="help-block">
                                <strong>{{ $errors->first('correos') }}</strong>
                            </span>
                        @endif

                    </div>
                </div>

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
                    <label for="password-confirm" class="control-label">Confirmar Contraseña:</label>

                    <div class="">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="">
                        <button class="btn btn-primary" type="submit">
                            Registro
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section("script")
    <script>
        // http://www.lawebdelprogramador.com

        /**
         * Funcion que añade un <li> dentro del <ul>
         */


    </script>
@endsection
@section("footer")
    @include("plantilla.footer")
@endsection
