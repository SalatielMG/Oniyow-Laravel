@extends("plantilla.template")
@section("encabezados")
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/about_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/about_responsive.css') }}">
@endsection
@section("contenido1")
    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col text-lg-center text-left">
                    <div class="newsletter_content">
                        <br>
                        <!-- Newsletter Title -->
                        <div class="newsletter_title">
                            <h1>Hola Admin <strong>"{{ $admin -> usuario }}"</strong></h1>
                            <span>¡ Bienvenido a su sistema ! </span>
                        </div>

                        <!-- Newsletter Form -->
                        <!--div class="newsletter_form_container">
                            <form action="#">
                                <div class="input-group">
                                    <input type="text" class="newsletter_email" placeholder="Buscar producto" required="required" data-error="Buscar un producto correcto." name="buscarP" id="buscarP" onkeyup="productosAjax('{{ route('venta.productosAjax') }}')">
                                    <button id="newsletter_form_submit" type="submit" class="button newsletter_submit_button trans_200" value="Submit" onclick="productosAjax('{{ route('venta.productosAjax') }}')">
                                        Buscar
                                    </button>
                                </div>
                            </form>
                        </div-->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="team">
        @include("plantilla.mens")
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-lg-center text-left team_title">
                    <h1>¿Qué quiere hacer?</h1>
                </div>
            </div>
            <div class="row">

                <!-- Team Item -->
                <div class="col-xl-3 col-lg-4 offset-xl-1 team_col">
                    <div class="team_container trans_200">
                        <div class="team_member_image"><img src="{{asset(Storage::url("basica.jpg"))}}" alt="" width="265px" height="175px"></div>
                        <div class="team_member_content">
                            <div class="team_member_name">Información</div>
                            <div class="team_member_title">básica</div>
                            <p>Ipsum dolor sit amet, conse ctetur adipiscing elit. Integ er sed dui eget lorem tinc idunt...</p>
                            <div class="team_member_link"><a href="#">Actualizar</a></div>
                        </div>
                    </div>
                </div>

                <!-- Team Item -->
                <div class="col-xl-3 col-lg-4 offset-xl-1 team_col">
                    <div class="team_container trans_200">
                        <div class="team_member_image"><img src="{{asset(Storage::url("fiscales.png"))}}" alt="" width="265px" height="175px"></div>
                        <div class="team_member_content">
                            <div class="team_member_name">Datos</div>
                            <div class="team_member_title">Fiscales</div>
                            <p>Ipsum dolor sit amet, conse ctetur adipiscing elit. Integ er sed dui eget lorem tinc idunt...</p>
                            @empty($admin -> datoFiscal)
                                <div class="team_member_link"><a href="{{route("datoFiscal.index")}}">Agregar</a></div>

                            @else

                                <div class="team_member_link"><a href="#">Actualizar</a></div>

                            @endempty
                        </div>
                    </div>
                </div>

                <!-- Team Item -->
                <div class="col-xl-3 col-lg-4 offset-xl-1 team_col">
                    <div class="team_container trans_200">
                        <div class="team_member_image"><img src="{{asset(Storage::url("IVA.jpg"))}}" alt="" width="265px" height="175px"></div>
                        <div class="team_member_content">
                            <div class="team_member_name">Configurar</div>
                            <div class="team_member_title">IVA</div>
                            <p>Ipsum dolor sit amet, conse ctetur adipiscing elit. Integ er sed dui eget lorem tinc idunt...</p>
                            <div class="team_member_link"><a href="#">Actualizar</a></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection