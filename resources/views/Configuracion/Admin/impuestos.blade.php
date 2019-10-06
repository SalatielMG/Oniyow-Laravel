@extends("plantilla.template")
@section("encabezados")
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/contact_responsive.css') }}">
@endsection
@section("contenido1")
    @include("plantilla.borde")
    <div class="container">


        <div class="row contact_row ">
            <div class="col-lg-8">

                <!-- Reply -->

                <div class="reply">

                    <div class="reply_title" style="font-size: 20px"><strong>Configurar Impuesto*</strong></div>
                    <div class="reply_form_container">

                        <!-- Reply Form -->
                        <label for="País">País</label>
                        <select id="País" name="País" class="input_field reply_form_email"  required autofocus style="width: 100%;" >
                            <option value="Mexico">Mexico</option>
                            <option value="Brasil">Brasil</option>
                            <option value="Estados Unidos"></option>

                        </select>
                        <label for="porcentaje">IVA</label>
                        <input id="porcentaje" class="input_field reply_form_subject" type="text" placeholder="Porcentaje" required="required" data-error="Subject is required.">
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>

            </div>


        </div>

    </div>
@endsection

