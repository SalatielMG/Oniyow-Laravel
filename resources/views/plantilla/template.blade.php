<!DOCTYPE html>
<html lang="en">
<head>
    <title>RanGO - Home</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="RanGO Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/slick-1.8.0/slick.css') }}">
    <link href="{{ asset('plugins/icon-font/styles.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/responsive.css') }}">
    <link href="{{ asset('css/mi_estilo.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bs4-floating-btn.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('toast/toastr.min.css') }}">
    @toastr_css
    @yield('encabezados')

</head>

<body>

<div class="super_container">

    <!-- Header -->

    <header class="header d-flex flex-row justify-content-end align-items-center trans_200">

        <!-- Logo -->
        <div class="logo mr-auto">
            <a href="{{ route('welcome') }}">Oni<span>yow</span></a>
        </div>
        <!-- Navigation -->
        <nav class="main_nav justify-self-end text-right">
            <ul>
                @guest
                    <li><a href="{{ route('login') }}">Iniciar sesion</a></li>
                    <li><a href="{{ route('register') }}">Registrarse</a></li>
                @else
                    @if(auth()->user()-> tipo === 'admin')
                        @include("plantilla.menuAdmin");
                    @else
                        @include("plantilla.menuCliente");
                    @endif
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            {{ Auth::user()->usuario }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                            @if(auth()->user()-> tipo === 'admin')
                                <a class="dropdown-item" href="{{ route('configuracion.edit', auth()->user()-> dato) }}" style="color: black">
                                    Configuración
                                </a>
                            @else
                                <a class="dropdown-item" href="{{ route('perfil.edit', auth()->user()-> dato) }}" style="color: black">
                                    Mi Perfil
                                </a>
                            @endif

                            <a class="dropdown-item " href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color: black">
                                Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            <div class="hamburger_container bez_1">
                <i class="fas fa-bars trans_200"></i>
            </div>
        </nav>
    </header>

    <!-- Menu -->

    <div class="menu_container">
        <div class="menu menu_mm text-right">
            <div class="menu_close"><i class="far fa-times-circle trans_200"></i></div>
            <ul class="menu_mm">
                <li class="menu_mm active"><a href="#">Home</a></li>
                <li class="menu_mm"><a href="about.html">About Us</a></li>
                <li class="menu_mm"><a href="services.html">Services</a></li>
                <li class="menu_mm"><a href="portfolio.html">Portfolio</a></li>
                <li class="menu_mm"><a href="blog.html">Blog</a></li>
                <li class="menu_mm"><a href="contact.html">Contact</a></li>
            </ul>
        </div>
    </div>



    <div class="">



                @yield('contenido1')


    </div>


    @yield("footer")

</div>
<script>
    var app = '{{ Request::root() }}';
    var token = '{{ csrf_token() }}';
    var regex_email = /^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/;
    var regex_num_celular = /^[0-9]{10}$/;
</script>
<script src="{{ asset('js_rango/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('plugins/slick-1.8.0/slick.js') }}"></script>
<script src="{{ asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('plugins/scrollTo/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('plugins/easing/easing.js') }}"></script>
<script src="{{ asset('js_rango/custom.js') }}"></script>

<script src="{{ asset('js/funcionesSCM.js') }}"></script>
<script src="{{ asset('js/funcionesCRM.js') }}"></script>
<script src="{{ asset('js/bs4-floating-btn.class.js') }}"></script>

<script type="text/javascript" src="{{ asset('toast/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('toast/toastr_render.js') }}"></script>
@toastr_js
@toastr_render
@yield('script')

</body>

</html>