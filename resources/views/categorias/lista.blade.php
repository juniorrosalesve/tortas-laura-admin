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
                <li class="inline-flex items-center">
                    <a href="{{ route('inventario') }}" class="roboto-medium inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-900">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="roboto-medium ml-1 text-sm font-medium text-gray-500 md:ml-2">
                            Inventario
                        </span>
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="roboto-medium ml-1 text-sm font-medium text-gray-500 md:ml-2">
                            Categorías
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex justify-between mb-7">
            <div>
                <h1 class="text-3xl">Categorías</h1>
            </div>
            <div>
                <button data-modal-target="registerData" data-modal-toggle="registerData" class="bg-primary px-4 py-1 text-white rounded">
                    Añadir
                </button>
            </div>
        </div>

        <table id="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Nombre</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
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
                    <form action="{{ route('store-categoria') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" required name="nombre" id="nombre" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                <label for="nombre" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nombre
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="roboto-light px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Guardar
                        </button>
                    </form>
                </div>
                <button data-modal-hide="registerData" id="insertHidden" type="button" class="hidden"></button>
            </div>
        </div>
    </div>
@endsection