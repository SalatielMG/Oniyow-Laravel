@php
    $tabla = session("compras");
    $badge = (!empty($tabla))?count($tabla):0;
@endphp
<li><a href="{{ route('venta.index') }}">Productos</a></li>
<li><a href="{{ route('venta.carrito') }}">Carrito <span id="badge" class="badge badge-light">{{ $badge }}</span> </a></li>
<li><a href="{{ route('cliente.compras') }}">Mis Compras</a></li>
<li><a href="{{ route('cliente.compras') }}">Contacto</a></li>