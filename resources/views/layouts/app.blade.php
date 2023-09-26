<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tortas de Laura</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/extra.css') }}">
    <link rel="stylesheet" href="{{  asset('css/dataTables.min.css') }}">
    <link href="{{ asset('css/flowbite.min.css') }}"  rel="stylesheet" />


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/flowbite.min.js') }}"></script>
</head>
<body>
    <div class="bg-primary flex justify-between">
        <div class="ml-10">
            <img src="{{ asset('images/logo-1.png') }}" alt="logo" id="logo" class="w-[140px]" />
        </div>
        <div class="my-auto mr-20">
            <p class="uppercase text-gray-200 roboto-regular">Sistema administrativo</p>
        </div>
    </div>
    <!-- Page Content -->
    <main>
        @yield('body')
    </main>

    <script>
        $(function(){
            $("#table, #table2").DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Sin resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrados de _MAX_ registros totales)",
                    "search": "Buscar",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Atras"
                    }
                },
                order:[
                    [0, 'asc']
                ]
            });
        })
    </script>
</body>
</html>
