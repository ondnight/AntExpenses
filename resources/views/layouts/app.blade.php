<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('styles') <!-- esto nos permite agregar estilos solo en algunas hojas con el helper push-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Ant Expenses</title>

    @vite('resources/css/app.css')

</head>

<body class="bg-gray-100">
    <header class="p-5 border-b bg-blue-500 shadow">
        <div class="container mx-auto flex justify-between items-baseline">
            <div class=" w-56 h-32">
                <div class=" px-5">
                    <a href="/">
                    <img class="w-max h-32" src="{{ asset('img/ant_logo.svg') }}" alt="Logo">
                </a>
                </div>
            </div>


            <div>


                @auth
                    <nav class="flex gap-4 items-center">
                        <a href="{{route('posts.index',['user' => auth()->user()->usuario])}}"
                            class="flex items-center gap-2 bg-white border p-2 hover:bg-gray-300 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                              </svg> 
                            Mi perfil
                        </a>

                        <a href="{{route('tickets.index',['user' => auth()->user()->usuario])}}"
                            class="flex items-center gap-2 bg-white border hover:bg-gray-300 p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                            </svg>
                            Tickets
                        </a>
                        <a href="{{route('informes.index',['user' => auth()->user()->usuario])}}"
                            class="flex items-center gap-2 bg-white border p-2 hover:bg-gray-300 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
                            </svg>
                            Informes
                        </a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" href="{{ route('logout') }}"
                                class="flex items-center gap-2 bg-white border hover:bg-red-300 p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>

                                Cerrar Sesión
                            </button>
                            <!-- controlamos la seguridad del logout mediante un post y un csrf para evitar ataques -->
                        </form>

                    </nav>
                @endauth


                @guest
                    <nav class="flex gap-2 items-strech">

                        <a href="{{ route('register') }}"
                            class="flex items-center gap-2 bg-white hover:bg-blue-300 border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                            Registrar
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>
                        </a>
                        <a href="{{ route('login') }}"
                            class="flex items-center gap-2 bg-white hover:bg-blue-300 border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                            Login
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>

                        </a>

                    </nav>
                @endguest
            </div>

    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-2xl mb-10">
            @yield('titule')
        </h2>
        <div class="grid grid-cols-3  ">

            <div>
    
            </div>
    
            @if(session('mensaje'))
            <div class=" text-center p-6 rounded text-sm uppercase font-bold text-green-600">
                {{ session('mensaje') }}
            </div>
            @endif
            @if(session('mensajeError'))
            <div class=" text-center p-6 rounded text-sm uppercase font-bold text-red-600">
                {{ session('mensajeError') }}
            </div>
            @endif
            <div>
    
            </div>
    
        </div>

        @yield('content')



    </main>
    <footer class="text-center p-5 text-gray-500 font-bold mt-10">

        Ant Expenses - Creado por Bruno Chandnani - Todos los derechos reservados {{ now()->year }}
        <!--esto es helper de laravel-->

    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>  
</body>



</html>
