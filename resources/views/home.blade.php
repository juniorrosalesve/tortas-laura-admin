@extends('layouts.app')
@section('body')
    <div class="grid grid-cols-5 gap-10 p-10 mt-10">
        {{-- <div onclick="location.href='caja.html'">
            <div class="bg-primary w-[75px] mx-auto p-2" style="border-radius: 100%;">
                <img src="./images/icons/caja.png" alt="caja" />
            </div>
            <h1 class="text-center text-lg mt-1 roboto-light">Caja Fácil</h1>
        </div> --}}
        <a href="{{ route('proveedores') }}">
            <div class="bg-primary w-[75px] mx-auto p-2" style="border-radius: 100%;">
                <img src="./images/icons/import.png" alt="proveedores" />
            </div>
            <h1 class="text-center text-lg mt-1 roboto-light">Proveedores</h1>
        </a>
        <div>
            <div class="bg-gray-600 w-[75px] mx-auto p-2" style="border-radius: 100%;">
                <img src="./images/icons/deposito.png" alt="materia-prima" />
            </div>
            <h1 class="text-center text-lg mt-1 roboto-light">Materia Prima</h1>
        </div>
        <a href="{{ route('inventario') }}">
            <div class="bg-primary w-[75px] mx-auto p-2" style="border-radius: 100%;">
                <img src="./images/icons/box.png" alt="inventario" />
            </div>
            <h1 class="text-center text-lg mt-1 roboto-light">Inventario</h1>
        </a>
        <a href="{{ route('ventas') }}">
            <div class="bg-primary w-[75px] mx-auto p-2" style="border-radius: 100%;">
                <img src="./images/icons/ventas.png" alt="ventas" />
            </div>
            <h1 class="text-center text-lg mt-1 roboto-light">Ventas</h1>
        </a>
        <div>
            <div class="bg-gray-600 w-[75px] mx-auto p-2" style="border-radius: 100%;">
                <img src="./images/icons/report.png" alt="report" />
            </div>
            <h1 class="text-center text-lg mt-1 roboto-light">Reportes</h1>
        </div>
        <div>
            <div class="bg-gray-600 w-[75px] mx-auto p-2" style="border-radius: 100%;">
                <img src="./images/icons/clientes.png" alt="clientes" />
            </div>
            <h1 class="text-center text-lg mt-1 roboto-light">Clientes</h1>
        </div>
        <a href="{{ route('empleados') }}">
            <div class="bg-primary w-[75px] mx-auto p-2" style="border-radius: 100%;">
                <img src="./images/icons/empleados.png" alt="empleados" />
            </div>
            <h1 class="text-center text-lg mt-1 roboto-light">Empleados</h1>
        </a>
        <div>
            <div class="bg-gray-600 w-[75px] mx-auto p-2" style="border-radius: 100%;">
                <img src="./images/icons/store.png" alt="tienda" />
            </div>
            <h1 class="text-center text-lg mt-1 roboto-light">Tienda</h1>
        </div>
        <!-- <div>
            <div class="bg-primary w-[75px] mx-auto p-2" style="border-radius: 100%;">
                <img src="./images/icons/usuarios.png" alt="usuarios" />
            </div>
            <h1 class="text-center text-lg mt-1 roboto-light">Usuarios</h1>
        </div> -->
    </div>
@endsection