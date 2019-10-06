@extends('plantilla.template')

@section('contenido1')
    @include("plantilla.borde")
    <!-- Team -->

    <div class="team">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-lg-center text-left team_title">
                    <h1>Quien eres?</h1>
                    <p>Porfavor elige un tipo de cliente para su registro </p>
                </div>
            </div>
            <div class="row">

                <!-- Team Item -->
                <div class="col-xl-5 col-lg-6 offset-xl-1 team_col">
                    <div class="team_container trans_200">
                        <div class="team_member_image"><img src="{{asset(Storage::url("empresa (2).jpg"))}}" alt=""></div>
                        <div class="team_member_content">
                            <div class="team_member_name">Empresa</div>
                            <div class="team_member_title">(Empresa)</div>
                            <p>Ipsum dolor sit amet, conse ctetur adipiscing elit. Integ er sed dui eget lorem tinc idunt...</p>
                            <div class="team_member_link"><a href="{{route('registroCliente', ['cliente' => 'empresa'])}}">registrar</a></div>
                        </div>
                    </div>
                </div>

                <!-- Team Item -->
                <div class="col-xl-5 col-lg-6 offset-xl-1 team_col">
                    <div class="team_container trans_200">
                        <div class="team_member_image"><img src="{{asset(Storage::url("persona.jpg"))}}" alt=""></div>
                        <div class="team_member_content">
                            <div class="team_member_name">Persona</div>
                            <div class="team_member_title">(Persona)</div>
                            <p>Ipsum dolor sit amet, conse ctetur adipiscing elit. Integ er sed dui eget lorem tinc idunt...</p>
                            <div class="team_member_link"><a href="{{route('registroCliente', ['cliente' => 'persona'])}}">registrar</a></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section("footer")
    @include("plantilla.footer")
@endsection
