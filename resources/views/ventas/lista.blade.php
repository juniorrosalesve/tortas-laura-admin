@extends('layouts.app')
@section('body')
    <div class="w-full p-10">
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="roboto-medium inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-900">
                        <svg class="w-3 h-3 mr-2.5 -mt-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Inicio
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="roboto-medium ml-1 text-sm font-medium text-gray-500 md:ml-2">
                            Ventas
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex justify-between mb-7">
            <div>
                <h1 class="text-3xl">Ventas</h1>
            </div>
            <div>
                <a href="{{ route('tasas') }}">
                    <button class="bg-secondary px-4 py-1 text-white rounded">
                        Tasa del dólar
                    </button>
                </a>
                <button data-modal-target="registerData" data-modal-toggle="registerData" class="bg-primary px-4 py-1 text-white rounded">
                    Añadir
                </button>
            </div>
        </div>

        <table id="table">
            <thead>
                <tr>
                    <td>PedidoId</td>
                    {{-- <td>Hora</td> --}}
                    <td>Producto</td>
                    <td>Cantidad</td>
                    <td>Precio del producto</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $fechaIndicada = '23-12-2023'; // Actualiza esto con la fecha que deseas
                    $productosAgrupados = array(); // Mover esta línea aquí
                @endphp
                
                @foreach ($ventas as $venta)
                    @if ($venta['finished'] == 0)
                        @continue
                    @endif
                    @php
                        $timestamp  =   $venta['created_at'] / 1000;
                        $date = new DateTime("@$timestamp");
                        $date->setTimezone(new DateTimeZone('America/Caracas'));
                        
                        // Convertir la fecha al formato "d-m-Y"
                        $fecha = $date->format('d-m-Y');
                        $xventas    =   [];
                    @endphp
                    @if ($fecha == $fechaIndicada)
                        @foreach ($venta['productos'] as $item)
                            {{-- @if ($item['despachoId'] == 1)
                                @continue
                            @endif
                            @if(strpos($item['nombre'], 'Merengada') === false && strpos($item['nombre'], 'Vaso') === false && strpos($item['nombre'], 'Batido') === false)
                                <tr>
                                    <td>{{ $venta['id'] }}</td>
                                    <td>{{ $date->format('d-m-y h:i A') }}</td>
                                    <td>{{ $item['nombre'] }}</td>
                                    <td>{{ $item['cantidad'] }}</td>
                                    <td>{{ $item['precio'] }}</td>
                                    <td>{{ $item['precio']*$item['cantidad'] }}</td>
                                </tr>
                            @endif --}}
                            <tr>
                                <td>{{ $venta['id'] }}</td>
                                {{-- <td>{{ $date->format('d-m-y h:i A') }}</td> --}}
                                <td>{{ $item['nombre'] }}</td>
                                <td>{{ $item['cantidad'] }}</td>
                                <td>{{ $item['precio'] }}</td>
                                <td>{{ $item['precio']*$item['cantidad'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </tbody>
            <!-- Cafes -->
            {{-- <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Despachado</th>
                    <th>Producto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $item)
                    @php
                        $cafes      =   [];
                        $despachado =   [];
                        if(!empty($item['productos'])) {
                            for($i = 0; $i < sizeof($item['productos']); $i++)
                            {
                                if($item['productos'][$i]['despachoId'] == 2 && $item['finished'] != 0) {
                                    if (strpos($item['productos'][$i]['nombre'], 'Merengada') === false && strpos($item['productos'][$i]['nombre'], 'Batido') === false) {
                                        $cafes[] = $item['productos'][$i]['nombre'];
                                        $timestamp  =   $item['productos'][$i]['delivery_at'] / 1000;
                                        $date = new DateTime("@$timestamp");
                                        $date->setTimezone(new DateTimeZone('America/Caracas'));
                                        $despachado[]   =   $date;
                                    }
                                }
                            }
                        }
                        $timestamp  =   $item['created_at'] / 1000;
                        $date = new DateTime("@$timestamp");
                        $date->setTimezone(new DateTimeZone('America/Caracas'));
                        $i = 0;
                    @endphp
                    @foreach ($cafes as $cafe)
                        <tr>
                            <td>{{ $date->format('d-m-y h:i A') }}</td>
                            <td>{{ $despachado[$i]->format('d-m-y h:i A') }}</td>
                            <td>{{ $cafe }}</td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                @endforeach
            </tbody> --}}
            {{-- <thead>
                <tr>
                    <td>Fecha</td>
                    <td>Mesa</td>
                    <td>Atendido por</td>
                    <td>Tasa</td>
                    <td>Total deuda</td>
                    <td>Total pagado VES</td>
                    <td>Total pagado</td>
                    <td>Vuelto VES</td>
                    <td>Vuelto</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $item)
                    <tr>
                        <td>
                            @php
                                $totalVES       =   0;
                                $totalDolar     =   0;
                                $deuda          =   0;
                                $vueltoVES      =   0;
                                $vueltoDolar    =   0;
                                
                                $timestamp = $item['created_at'] / 1000;
                                $date = new DateTime("@$timestamp");
                                $date->setTimezone(new DateTimeZone('America/Caracas'));
                                if(isset($item['pagos']) && !empty($item['pagos'])) {
                                    for($i = 0; $i < sizeof($item['pagos']); $i++) {
                                        if(!$item['pagos'][$i]['isDolar'])
                                            $totalVES       +=  $item['pagos'][$i]['monto'];
                                        else
                                            $totalDolar     +=  $item['pagos'][$i]['monto'];
                                    }
                                }
                                if(isset($item['productos']) && !empty($item['productos'])) {
                                    for($i = 0; $i < sizeof($item['productos']); $i++)
                                        $deuda  +=  $item['productos'][$i]['precio'];
                                }
                                if(isset($item['vueltos']) && !empty($item['vueltos'])) {
                                    for($i = 0; $i < sizeof($item['vueltos']); $i++) {
                                        if(!$item['vueltos'][$i]['isDolar'])
                                            $vueltoVES      +=   $item['vueltos'][$i]['monto'];
                                        else 
                                            $vueltoDolar    +=   $item['vueltos'][$i]['monto'];
                                    }
                                }
                                $nombreCompleto = $item['empleado'];
                                $partes = explode(' ', $nombreCompleto); // Divide el nombre completo en partes
                                $primerNombre = $partes[0]; // El primer nombre es la primera parte
                                $primerLetraApellido = substr($partes[1], 0, 3); // La primera letra del apellido es el primer carácter de la segunda parte
                                $nombreFormateado = $primerNombre . ' ' . $primerLetraApellido . '.'; // Combina el primer nombre y la primera letra del apellido
                            @endphp
                            {{ $date->format('d-m-y h:i A'); }}
                        </td>
                        <td>{{ ($item['mesa'] == 0 ? 'Caja' : $item['mesa']) }}</td>
                        <td>{{ $nombreFormateado }}</td>
                        <td>{{ $item['tasa'] }}</td>
                        <td>${{ number_format($deuda, 2, ".", ",") }}</td>
                        <td>{{ number_format($totalVES, 2, ".", ",") }} VES</td>
                        <td>${{ number_format($totalDolar, 2, ".", ",") }}</td>
                        <td>{{ number_format($vueltoVES, 2, ".", ",") }} VES</td>
                        <td>${{ number_format($vueltoDolar, 2, ".", ",") }}</td>
                        <td>
                            @php
                                $tasas  =   [
                                    ($totalVES == 0 ? 0 : $totalVES/$item['tasa']),
                                    ($vueltoVES == 0 ? 0 : $vueltoVES/$item['tasa'])
                                ];
                                $total  =  ($tasas[0]+$totalDolar);
                                $total  =  ($total-($tasas[1]+$vueltoDolar)); 
                            @endphp
                            ${{ number_format($total, 2, ".", ",") }}
                        </td>
                    </tr>
                @endforeach
            </tbody> --}}
        </table>
    </div>

    <div id="registerData" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-[1024px] max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl text-gray-900 roboto-mediumitalic">
                        Añadir Categoría
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="registerData">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <!-- CONTENT -->

                </div>
                <button data-modal-hide="registerData" id="insertHidden" type="button" class="hidden"></button>
            </div>
        </div>
    </div>
@endsection