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
                            Inventario
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex justify-between mb-7">
            <div>
                <h1 class="text-3xl">Productos</h1>
            </div>
            <div>
                <a href="{{ route('categorias') }}">
                    <button type="button" class="bg-yellow-600 px-4 py-1 text-white rounded">
                        Categorías
                    </button>
                </a>
                <button id="btnRegisterData" data-modal-target="registerData" data-modal-toggle="registerData" class="bg-primary px-4 py-1 text-white rounded">
                    Añadir
                </button>
            </div>
        </div>

        <table id="table">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Nombre</td>
                    <td>Cantidad</td>
                    <td>Precio de compra</td>
                    <td>Precio de venta</td>
                    <td>Ganancia</td>
                    <td>% de Ganancia</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>${{ number_format($item->costo, 2, ".", ",") }}</td>
                        <td>${{ number_format($item->precio, 2, ".", ",") }}</td>
                        <td>${{ number_format($item->precio - $item->costo, 2, ".", ",") }}</td>
                        <td>{{ round(($item->precio-$item->costo)*100) }}%</td>
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
                        Añadir Producto
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
                    <form action="{{ route('store-producto') }}" id="formInsert" method="POST">
                        @csrf
                        <h1 class="mb-1 text-md roboto-light">Ingresando por</h1>
                        <div class="grid grid-cols-2 gap-6 mb-10">
                            <div class="flex items-center pl-4 border border-gray-200 rounded">
                                <input id="bordered-radio-1" type="radio" value="Proveedor" name="ingresaPor" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="bordered-radio-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Proveedor o Compra
                                </label>
                            </div>
                            <div class="flex items-center pl-4 border border-gray-200 rounded">
                                <input id="bordered-radio-2" type="radio" value="Producción" name="ingresaPor" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="bordered-radio-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Producción
                                </label>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="nombre" id="nombre" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                <label for="nombre" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nombre
                                </label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="number" value="0" min="1" name="cantidad" id="cantidad" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                <label for="cantidad" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Cantidad
                                </label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <select name="categoriaId" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    <option value="" selected>Elige una opción</option>
                                    @foreach ($categorias as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Categoría
                                </label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group" id="costoPorUnidad">
                                <input type="number" name="costo" step="0.01" id="costo" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                <label for="costo" id="label-costo" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Costo por Unidad
                                </label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="number" name="precio" step="0.01" id="precio" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                <label for="precio" id="label-costo" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Precio por Unidad
                                </label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group" id="proveedor_container">
                                <select name="proveedorId" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    <option value="" selected>Elige una opción</option>
                                    @foreach ($proveedores as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="proveedor" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Proveedor
                                </label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <select name="despachoId" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    <option value="" selected>Elige una opción</option>
                                    <option value="1">Caja 1</option>
                                    <option value="2">Caja 2</option>
                                </select>
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Se despacha por
                                </label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group" id="produceIn">
                                <select name="inLocal" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    <option value="1">Local</option>
                                    <option value="0">Bodega</option>
                                </select>
                                <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Se produce en
                                </label>
                            </div>
                        </div>
                        <div class="my-5" id="addMateriaPrima">
                            <div class="flex justify-between mt-3 mb-5">
                                <div>
                                    <h1 class="inline">Materia prima</h1>
                                    <button type="button" class="py-0.1 px-1 rounded-lg text-slate-200 bg-green-600 inline" onclick="addMateriaPrima()">+</button>
                                </div>
                                <div>
                                    <h1 id="MT_Total"><span class='text-xs'>Total costo de producción:</span> $0.00</h1>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-6 my-3" id="materia_prima_1">
                                <div class="relative z-0 w-full mb-6 group">
                                    <select name="materiaPrima[]" onchange="onChangeMateriaPrimaProduct(this, 1)" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="" selected>Elige una opción</option>
                                        @foreach ($materias_primas as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Elegir producto
                                    </label>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="text" readonly id="MT_InStock_1" class="border-gray-300 block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                    <label id="MT_InStockText_1" class="text-gray-500 peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        In Stock
                                    </label>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="number" readonly id="MT_Costo_1" name="materiaPrimaCosto[]"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                    <label id="label-costo" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Costo
                                    </label>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="number" name="materiaPrimaCantidad[]" onkeyup="mtChangeCantidad(this, 1)" step="0.01"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                    <label id="label-costo" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Cantidad
                                    </label>
                                </div>
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

    <div class="grid grid-cols-4 gap-6 my-3 hidden" id="clonateMateriaPrima">
        <div class="relative z-0 w-full mb-6 group">
            <select name="materiaPrima[]" id="MT_Product_" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                <option value="" selected>Elige una opción</option>
                @foreach ($materias_primas as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </select>
            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Elegir producto
            </label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" readonly id="MT_InStock_" class="border-gray-300 block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
            <label id="MT_InStockText_" class="text-gray-500 peer-focus:font-medium absolute text-sm duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                In Stock
            </label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="number" readonly id="MT_Costo_" name="materiaPrimaCosto[]"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
            <label id="label-costo" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Costo
            </label>
        </div>
        <div class="relative z-0 w-full mb-6 group" id="MT_Cantidad_Container">
            <input type="number" name="materiaPrimaCantidad[]" id="MT_Cantidad_" step="0.001"  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
            <label id="label-costo" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Cantidad
            </label>
        </div>
    </div>

    <script>
        $("#addMateriaPrima").hide();
        $("#produceIn").hide();

        let showBy  =   1;
        let cachePrice  =   [];
        let actualMateriaPrima  =   2;
        const materiaPrima  =   @json($materias_primas);

        function addMateriaPrima() {
            const append    =   document.getElementById('clonateMateriaPrima');
            const body      =   document.getElementById('addMateriaPrima');
            let newInput    =   body.appendChild(append.cloneNode(true));
            newInput.removeAttribute('id');
            newInput.classList.remove('hidden');

            $(newInput).attr('id', 'materia_prima_'+actualMateriaPrima);
            $("#materia_prima_"+actualMateriaPrima+" #MT_Product_").attr('onchange', 'onChangeMateriaPrimaProduct(this, '+actualMateriaPrima+')');
            $("#materia_prima_"+actualMateriaPrima+" #MT_Product_").attr('id', 'MT_Product_'+actualMateriaPrima);
            $("#materia_prima_"+actualMateriaPrima+" #MT_InStock_").attr('id', 'MT_InStock_'+actualMateriaPrima);
            $("#materia_prima_"+actualMateriaPrima+" #MT_InStockText_").attr('id', 'MT_InStockText_'+actualMateriaPrima);
            
            $("#materia_prima_"+actualMateriaPrima+" #MT_Costo_").attr('id', 'MT_Costo_'+actualMateriaPrima);

            $("#materia_prima_"+actualMateriaPrima+" #MT_Cantidad_").attr('onkeyup', 'mtChangeCantidad(this, '+actualMateriaPrima+')');
            $("#materia_prima_"+actualMateriaPrima+" #MT_Cantidad_").attr('id', 'MT_Cantidad_'+actualMateriaPrima);

            $("#materia_prima_"+actualMateriaPrima+" #MT_Cantidad_Container").append('<span class="btn btn-xs btn-error float-right -mr-3 cursor-pointer text-red-600 -mt-10" onclick="removeInputCronograma(\'materia_prima_'+actualMateriaPrima+'\', '+actualMateriaPrima+')">x</span>');
        

            actualMateriaPrima++;
        }
        function removeInputCronograma(div, id) {
            $("#"+div).remove();
            let newCache    =   [];
            for(var i = 0; i < cachePrice.length; i++) {
                if(cachePrice[i].id != id)
                {
                    newCache.push({
                        id:cachePrice[i].id,
                        value:cachePrice[i].value
                    });
                }
            }
            cachePrice  =   newCache;

            let mtTotal     =   0;
            for(var i = 0; i < cachePrice.length; i++)
                mtTotal     =  (cachePrice[i].value+mtTotal);
            $("#MT_Total").html("<span class='text-xs'>Total costo de producción:</span> $"+mtTotal.toFixed(2));
            actualMateriaPrima--;
        }

        function onChangeMateriaPrimaProduct(e, id) {
            const value     =   e.value;
            if(value == undefined || value == "") {
                $("#MT_Product_"+id).val("");
                $("#MT_InStock_"+id).val("");
                $("#MT_Cantidad_"+id).val("");
                $("#MT_Costo_"+id).val("");
            }
            const mt    =   getMateriaPrimaProduct(value);
            if(mt != null)
            {
                $("#MT_InStock_"+id).val(mt.cantidad*mt.presentacion+" "+mt.unidad);
                if(mt.unidad != 'Unidad')
                    $("#MT_Costo_"+id).val(mt.costo/1000);
                else
                    $("#MT_Costo_"+id).val(((mt.cantidad*mt.costo)/mt.cantidad)/mt.presentacion);
            }
        }

        function mtChangeCantidad(e, id) {
            let value1      =   $("#MT_InStock_"+id).val();
            const price     =   $("#MT_Costo_"+id).val();
            value1  =   value1.replace(/[^0-9]/g, "");
            const value2    =   e.value;
            if(value2 > Math.floor(value1)) {
                if($("#MT_InStock_"+id).has("border-gray-300")) {
                    $("#MT_InStock_"+id).removeClass('border-gray-300');
                    $("#MT_InStockText_"+id).removeClass('text-gray-500');
                    $("#MT_InStock_"+id).addClass('border-red-300');
                    $("#MT_InStockText_"+id).addClass('text-red-500');
                }
            } else {
                if($("#MT_InStock_"+id).has("border-red-300")) {
                    $("#MT_InStock_"+id).removeClass('border-red-300');
                    $("#MT_InStockText_"+id).removeClass('text-red-500');
                    $("#MT_InStock_"+id).addClass('border-gray-300');
                    $("#MT_InStockText_"+id).addClass('text-gray-500');
                }
            }
            let exists  =   false;
            if(cachePrice.length > 0) {
                for(var i = 0; i < cachePrice.length; i++) {
                    if(cachePrice[i].id == id)
                    {
                        // const costoPerGramo     =   price/1000;

                        cachePrice[i].value     =   price*value2;
                        exists  =   true;
                        break;
                    }
                }
            }
            if(!exists)
                cachePrice.push({
                    id:id,
                    value:(value2*price)
                });

            let mtTotal     =   0;
            for(var i = 0; i < cachePrice.length; i++)
                mtTotal     =  (cachePrice[i].value+mtTotal);
            $("#MT_Total").html("<span class='text-xs'>Total costo de producción:</span> $"+mtTotal.toLocaleString('es-VE'));
        }

        function getMateriaPrimaProduct(id) {
            let get     =   null;
            for(var i = 0; i < materiaPrima.length; i++) {
                if(materiaPrima[i].id == id)
                {
                    get     =   materiaPrima[i];
                    break;
                }
            }
            return get;
        }

        $('#formInsert input').on('change', function() {
            let ingresaPor  =   $('input[name=ingresaPor]:checked', '#formInsert').val();
            if(ingresaPor == 'Proveedor') {
                if(showBy == 1)
                    return;
                $("#addMateriaPrima").hide();
                $("#produceIn").hide();
                $("#costoPorUnidad").show();
                showBy = 1;
            }
            else {
                if(showBy == 2)
                    return;
                $("#addMateriaPrima").show();
                $("#produceIn").show();
                $("#costoPorUnidad").hide();
                showBy = 2;
            }     
        });
    </script>
@endsection