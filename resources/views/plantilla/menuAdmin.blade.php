<li class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Productos
    </a>
    <div class="dropdown-menu transparencia" aria-labelledby="navbarDropdown ">
        <a  class="dropdown-item" href="{{ route('producto.index') }}">Productos</a>
        <a  class="dropdown-item" href="{{ route('promocion.index') }}">Promociones</a>
        <div class="dropdown-divider"></div>
        <a  class="dropdown-item disabled" href="{{ route('venta.index') }}">Venta</a>
        <a  class="dropdown-item disabled" href="{{ route('venta.carrito') }}">Carrito</a>
        <a  class="dropdown-item" href="{{ route('devolucion.index') }}">Devolucion</a>
    </div>
</li>



<li class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Materias
    </a>
    <div class="dropdown-menu transparencia" aria-labelledby="navbarDropdown ">
        <a  class="dropdown-item" href="{{ route('medida.index') }}">Unidades de Medida</a>
        <a  class="dropdown-item" href="{{ route('materia.index') }}">Materias</a>
        <a  class="dropdown-item" href="{{ route('provisiona.create') }}">Comprar al proveedor</a>
        <div class="dropdown-divider"></div>
        <a  class="dropdown-item" href="{{ route('provisiona.index') }}">Hist.Provisiones</a>
    </div>
</li>


<li class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Produccion
    </a>
    <div class="dropdown-menu transparencia" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('metodofabrica.create') }}">Crear Metodo de Fabrica</a>
        <a class="dropdown-item" href="{{ route('metodofabrica.index') }}">Ver Metodos de Fabrica</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('produccion.create') }}">Nueva Producción </a>
        <a class="dropdown-item" href="{{ route('produccion.index') }}">Hist. de Producciones </a>
    </div>
</li>