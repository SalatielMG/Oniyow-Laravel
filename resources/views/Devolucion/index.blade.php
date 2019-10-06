@extends("plantilla.template")
@section("contenido1")

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col text-lg-center text-left">
                    <div class="newsletter_content">
                        <br>
                        <!-- Newsletter Title -->
                        <div class="newsletter_title">
                            <h1>Ventas realizadas</h1>
                            <span>Todas la ventas en un solo lugar</span>
                        </div>

                        <!-- Newsletter Form -->
                        <div class="newsletter_form_container">
                            <form action="#">
                                <div class="input-group">
                                    <input type="text" class="newsletter_email" placeholder="Buscar venta" required="required" data-error="Buscar un producto correcto." name="buscarV" id="buscarV" >
                                    <button id="newsletter_form_submit" type="button" class="button newsletter_submit_button trans_200" value="Submit" onclick="buscarAnimal()">
                                        Buscar
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection