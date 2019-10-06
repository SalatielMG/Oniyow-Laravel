<div class="row">
    @foreach($materias as $m)
        <div class="card col-3">
            <img class="card-img-top" src="{{ asset(Storage::url($m->imagen)) }}" width="100" alt="Card image cap">
            <div class="card-body">
                <h3 class="card-title">{{ $m->nombre }}</h3>
                <p class="card-text text-dark">
                    Descripcion: <b>{{ $m->descripcion }}</b> <br>
                    Existencia: <b>{{ $m->stock }}</b> <br>
                    Unidad de Medida: <b>{{ $m->medida }}</b>
                </p>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-provisiona" onclick="abrirModalProvisiona({{ json_encode($m) }})">Agregar</a>
            </div>
        </div>
    @endforeach

</div>
