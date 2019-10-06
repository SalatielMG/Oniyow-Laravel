@extends("plantilla.template")
@section("contenido1")
    @include("plantilla.bordeSCM")
    <div class="container mb-5 mt-5">
        <h1>Métodos de Fabrica !!!</h1>



        <div class="mb-5 mt-5">

            <form class="" method="POST" action="{{ route('produccion.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <h3>Producto : </h3>
                <select id="producto" name="producto" class="form-control mb-5" onchange="changeSelecProductos()">
                    @foreach($productos as $p)
                        <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                    @endforeach
                </select>

                <div class=" mb-5">
                    <h3>Metodos de Fabrica : </h3>
                    <select id="metodo" name="metodo" class="form-control" onchange="changeSelectMetodo()" >

                    </select>
                </div>

                <div id="materiasEnOcupa" class="mb-5">

                </div>



            </form>
        </div>









        @endsection

        @section("script")
            <script type="text/javascript">

                window.onload = function() {
                    changeSelecProductos();
                }


            </script>
@endsection