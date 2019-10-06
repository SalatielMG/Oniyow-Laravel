@extends("plantilla.templatePDF")
@section("encabezados")
    <style type="text/css" media="screen">
        *{
            font-weight: 400;
            font-size: 16px;
        }
        div.table-title {
            display: block;
            margin: auto;
            max-width: 600px;
            padding:5px;
            width: 100%;
        }
        .table-title h3 {
            color: #fafafa;
            font-size: 30px;
            font-weight: 400;
            font-style:normal;
            font-family: "Roboto", helvetica, arial, sans-serif;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            text-transform:uppercase;
        }

        /*** Table Styles **/

        .table-fill {
            background: white;
            border-radius:3px;
            border-collapse: collapse;
            height: 320px;
            margin: auto;
            max-width: 600px;
            padding:5px;
            width: 100%;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            animation: float 5s infinite;
        }

        th {
            color:#D5DDE5;;
            background:#1b1e24;
            border-bottom:4px solid #9ea7af;
            border-right: 1px solid #343a45;
            font-size:23px;
            font-weight: 100;
            padding:24px;
            text-align:left;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            vertical-align:middle;
        }

        th:first-child {
            border-top-left-radius:3px;
        }

        th:last-child {
            border-top-right-radius:3px;
            border-right:none;
        }

        tr {
            border-top: 1px solid #C1C3D1;
            border-bottom-: 1px solid #C1C3D1;
            color:#666B85;
            font-size:16px;
            font-weight:normal;
            text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
        }

        tr:hover td {
            background:#4E5066;
            color:#FFFFFF;
            border-top: 1px solid #22262e;
        }

        tr:first-child {
            border-top:none;
        }

        tr:last-child {
            border-bottom:none;
        }

        tr:nth-child(odd) td {
            background:#EBEBEB;
        }

        tr:nth-child(odd):hover td {
            background:#4E5066;
        }

        tr:last-child td:first-child {
            border-bottom-left-radius:3px;
        }

        tr:last-child td:last-child {
            border-bottom-right-radius:3px;
        }

        td {
            background:#FFFFFF;
            padding:20px;
            text-align:left;
            vertical-align:middle;
            font-weight:300;
            font-size:18px;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #C1C3D1;
        }

        td:last-child {
            border-right: 0px;
        }

        th.text-left {
            text-align: left;
        }

        th.text-center {
            text-align: center;
        }

        th.text-right {
            text-align: right;
        }

        td.text-left {
            text-align: left;
        }

        td.text-center {
            text-align: center;
        }

        td.text-right {
            text-align: right;
        }
    </style>
@endsection

@section("contenido1")


    <h1 class="text-center"><strong>FACTURA </strong></h1>
    <br>

    <div class="row">
        <div class="col text-right" >
            <label for=""><strong>Factura: </strong></label>
            <label for="">{{$factura -> folio}}</label>
            <br>
            <label for=""><strong>Fecha y hora de emision:</strong></label>
            <label for="">{{$factura -> created_at}}</label>
        </div>
        <br>
        ---------------------------------------------------------------------------------------------------------------------
        <div class="col text-justify">
            <h2><strong>{{$admin -> nombre}} {{$admin -> apellido}}</strong></h2>
            <label for=""><strong>RFC:  </strong>{{$admin -> datoFiscal -> RFC}}</label><br>
            <label for="">{{$admin -> datoFiscal -> calle}}. {{$admin -> datoFiscal -> numinterior}} {{$admin -> datoFiscal -> numexterior}}</label>
            <br>
            <label for="">{{$admin -> datoFiscal -> colonia}}, {{$admin -> datoFiscal -> municipio}}. C.P. {{$admin -> datoFiscal -> cp}}</label>
            <br>
            <label for=""><strong>Tel.:  </strong>
                @foreach($admin -> datoC -> telefonos as $tel)
                    @if($admin -> datoC -> telefonos -> last() == $tel)
                        {{$tel -> numero}}
                    @else
                        {{$tel -> numero}},
                    @endif
                @endforeach
            </label>
            <br>
            <label for=""><strong>E-Mail.:  </strong>
                @foreach($admin -> datoC -> emails as $email)
                    @if($admin -> datoC -> emails -> last() == $email)
                        {{$email -> email}}
                    @else
                        {{$email -> email}},
                    @endif
                @endforeach
            </label>
        </div>
        <br>
        ---------------------------------------------------------------------------------------------------------------------
        <div class="col">
            @if($factura -> ventaF -> clienteC -> tipo == "admin")
                <h2><strong>Cliente: </strong> {{$factura -> ventaF -> clienteC -> nombre}} </h2>
                <h2><strong>Representante Legal: </strong> {{$factura -> ventaF -> clienteC -> apellido}} </h2>
            @else
                <h2><strong>Cliente: </strong> {{$factura -> ventaF -> clienteC -> nombre}} {{$factura -> ventaF -> clienteC -> apellido}}</h2>
            @endif

            <label for=""><strong>RFC.: </strong>{{$factura -> ventaF -> clienteC -> datoFiscal -> RFC}}</label><br>
            <label for="">{{$factura -> ventaF -> clienteC -> datoFiscal -> calle}}. {{$factura -> ventaF -> clienteC -> datoFiscal -> numinterior}} {{$factura -> ventaF -> clienteC -> datoFiscal -> numexterior}}</label>
            <br>
            <label for="">{{$factura -> ventaF -> clienteC -> datoFiscal -> colonia}}, {{$factura -> ventaF -> clienteC -> datoFiscal -> municipio}}. C.P. {{$factura -> ventaF -> clienteC -> datoFiscal -> cp}}</label><br>
            <label for=""><strong>Tel.: </strong>
                @foreach($factura -> ventaF -> clienteC -> datoC -> telefonos as $tel)
                    @if($factura -> ventaF -> clienteC -> datoC -> telefonos -> last() == $tel)
                        {{$tel -> numero}}
                    @else
                        {{$tel -> numero}},
                    @endif
                @endforeach
            </label><br>
            <label for=""><strong>E-Mail.: </strong>
                @foreach($factura -> ventaF -> clienteC -> datoC -> emails as $mail)
                    @if($factura -> ventaF -> clienteC -> datoC -> emails -> last() == $mail)
                        {{$mail -> email}}
                    @else
                        {{$mail -> email}},
                    @endif
                @endforeach
            </label>
        </div>
    </div>

    <div class="card-body">
        @php
            $x = 1;
            $total = 0;
        @endphp
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="text-left">#</th>
                <th class="text-left">Producto</th>
                <th class="text-left">Cantidad</th>
                <th class="text-left">Precio Original</th>
                <th class="text-left">Promocion</th>
                <th class="text-left">SubTotal</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @foreach($factura -> ventaF -> productos as $p)
                @php
                    $precio = $p["precio"] - (($p["precio"] * $p -> pivot -> porcentaje) / 100);
                    $st = $p -> pivot -> cantidad * $precio;
                    $total += $st;
                @endphp
                <tr>
                    <td>{{ $x++ }}</td>
                    <td>{{ $p["nombre"] }}</td>
                    <td>{{ $p -> pivot -> cantidad }}</td>
                    <td>${{ number_format($p["precio"], 2, ".", "") }}</td>
                    <td>{{ ($p -> pivot -> porcentaje == 0) ? "NA": $p -> pivot -> porcentaje . "%" }}</td>
                    <td>${{ number_format($st, 2, ".", "") }} </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" align="right"><strong>Total</strong></td>
                <td>${{ number_format($total,2,".","") }} </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection