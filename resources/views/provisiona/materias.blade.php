<div class="row">
    @foreach($materias as $m)
        <div class="card col-3 justify-content-center">
            <img class="card-img" src="{{ asset(Storage::url($m->imagen)) }}" width="100px" height="100px">
            <div class="card-body">
                <h2 class="card-title text-center ">{{ $m->nombre }}</h2>
                <p class="card-text text-dark">
                    Descripcion: <b>{{ $m->descripcion }}</b> <br>
                    Existencia: <b>{{ $m->stock }}</b> <br>
                    Unidad de Medida: <b>{{ $m->medida }}</b>
                </p>
                <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#modal-provisiona" onclick="abrirModalProvisiona({{ json_encode($m) }})">Solicitar</a>
            </div>
        </div>
    @endforeach

</div>
