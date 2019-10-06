@extends("plantilla.template")
@section("encabezados")
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/contact_responsive.css') }}">
@endsection
@section("contenido1")
    @include("plantilla.borde")
    @include("venta.modalEmail")
    @include("venta.modalTelefono")
    <div class="container">

        <div class="row contact_row">
            <div class="col-lg-8">

                <!-- Reply -->

                <div class="reply">

                    <div class="reply_title"><strong>DATOS FISCALES *</strong></div>
                    <div class="reply_form_container">

                        <!-- Reply Form -->

                        <form id="reply_form" method="POST" action="{{ route('datoFiscal.store',  ["idVenta" => $idVenta, "accion" => $accion]) }}" >
                            {{ csrf_field() }}
                            <div>
                                @if($cliente -> tipo == "empresa")
                                    <div class="reply_title">Datos de la Empresa</div>
                                @else
                                    <div class="reply_title">Datos de la Persona Moral</div>
                                @endif

                                <div class="form-row">
                                    <div class="col">
                                        <input id="nombre" name="nombre" class="input_field reply_form_name" type="text"  data-error="Name is required." disabled value="{{$cliente -> nombre}}" style="width: 100%">

                                    </div>
                                    <div class="col">
                                        <input id="apellido" name="apellido" class="input_field reply_form_email" type="text"  data-error="Valid email is required." disabled value="{{$cliente -> apellido}}" style="width: 100%">

                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('rfc') ? ' has-error' : '' }}">
                                            <div class="">
                                                <input id="rfc" name="rfc"class="input_field reply_form_name" type="text" placeholder="RFC" value="{{ old('rfc') }}" required autofocus style="width: 100%;" >

                                                @if ($errors->has('rfc'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('rfc') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group{{ $errors->has('emails') ? ' has-error' : '' }}">
                                            <div class="">
                                                <select id="emails" name="emails" class="input_field reply_form_email" value="{{ old('emails') }}" required autofocus style="width: 100%;" ></select>
                                                @if ($errors->has('emails'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('emails') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-outline-success" style="margin-left: 45px; margin-top: 8px;" data-toggle="modal" data-target="#modal-correo" >+</button>
                                    </div>
                                </div>





                                <div class="form-group{{ $errors->has('telefonos') ? ' has-error' : '' }}">
                                    <div class="">
                                        <select id="telefonos" class="input_field reply_form_name" name="telefonos" value="{{ old('telefonos') }}" required autofocus ></select>
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-telefono">+</button>
                                        @if ($errors->has('telefonos'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('telefonos') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="reply_title" style="margin-top:50px">Domicilio</div>
                                <div class="form-group{{ $errors->has('calle') ? ' has-error' : '' }}">
                                    <div class="">
                                        <input id="calle" name="calle" class="input_field reply_form_subject" type="text" placeholder="Calle" value="{{ old('calle') }}" required autofocus>
                                        @if ($errors->has('calle'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('calle') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('ninterior') ? ' has-error' : '' }}">
                                            <div class="">
                                                <input id="ninterior"  name="ninterior" class="input_field reply_form_name" type="text" placeholder="Num. interior" value="{{ old('ninterior') }}" required autofocus style="width: 100%;" >
                                                @if ($errors->has('ninterior'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('ninterior') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('nexterior') ? ' has-error' : '' }}">
                                            <div class="">
                                                <input id="nexterior" name="nexterior" class="input_field reply_form_email" type="text" placeholder="Num. exterior" value="{{ old('nexterior') }}" autofocus style="width: 100%;"
                                                >
                                                @if ($errors->has('nexterior'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('nexterior') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('colonia') ? ' has-error' : '' }}">
                                            <div class="">
                                                <input id="colonia"  name="colonia" class="input_field reply_form_name" type="text" placeholder="Colonia" value="{{ old('colonia') }}" required autofocus style="width: 100%;" >

                                                @if ($errors->has('colonia'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('colonia') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('cp') ? ' has-error' : '' }}">
                                            <div class="">
                                                <input id="cp" name="cp" class="input_field reply_form_email" type="number" placeholder="Codigo Postal" value="{{ old('cp') }}" required autofocus style="width: 100%;" >
                                                @if ($errors->has('cp'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('cp') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('municipio') ? ' has-error' : '' }}">
                                            <div class="">
                                                <input id="municipio"  name="municipio" class="input_field reply_form_name" type="text" placeholder="Municipio"  value="{{ old('municipio') }}" required autofocus  style="width: 100%;" >
                                                @if ($errors->has('municipio'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('municipio') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                                            <div class="">
                                                <input id="estado" name="estado" class="input_field reply_form_email" type="text" placeholder="Estado" value="{{ old('estado') }}" required autofocus style="width: 100%;" >
                                                @if ($errors->has('estado'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('estado') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <button id="reply_form_submit" type="submit" class="reply_submit_btn trans_300" value="Submit">
                                    Enviar
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

            <div class="col-lg-4">

                <!-- Contact Info -->

                <div class="contact_info">
                    @if($cliente -> tipo == "empresa")
                        <div class="contact_title" style="text-align: center"><strong>Acerca de la empresa</strong></div>
                    @else
                        <div class="contact_title" style="text-align: center"><strong>Acerca de usted</strong></div>
                    @endif

                    <div class="contact_info_container">

                        <div class="logo contact_logo">
                            <a href="#" style="text-align: center; margin-left: 20px;"><span>{{$cliente -> nombre}}</span></a>
                        </div>
                        <h2 style="text-align: center"> {{$cliente -> apellido}} </h2>

                        <div class="address_container clearfix">
                            <div class="contact_info_icon">i</div>
                            <div class="contact_info_content">
                                <ul>
                                    <li class="address">{{$cliente -> datoC -> domicilioparticular}}</li>
                                    <li class="city">{{$cliente -> sitioweb}}</li>
                                    @foreach($cliente -> datoC -> telefonos as $tel)
                                        <li class="phone">{{$tel -> numero}}</li>
                                    @endforeach
                                    @foreach($cliente -> datoC -> emails as $mail)
                                        <li class="email">{{$mail -> email}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
@section("script")
    <script type="text/javascript">
        $(document).ready(function(){
            ajaxEmails('{{ route('datoFiscal.emailsAjax') }}');
            ajaxTelefonos('{{ route('datoFiscal.telefonosAjax') }}')
        });
    </script>
@endsection