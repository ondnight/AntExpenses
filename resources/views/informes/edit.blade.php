@extends('layouts.app')

@section('titule')
    <div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
        Edición de Informe nº: {{ $informeSeleccionado->id }}
        <a href="{{ route('informes.index', ['user' => auth()->user()->usuario]) }}"
            class="flex items-center gap-2 bg-red-800 border p-2 mb-3 ml-5 text-white 
rounded text-sm uppercase font-bold cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>

            Volver</a>
    </div>
@endsection


@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        
            <div class="md:w-6/12 p-5">
                <img src="{{ asset('img/informes.jpg') }}" alt="Imagen tickets">
            </div>
            <div class="md:w-4/12 bg-white p-10 rounded-lg shadow-xl mt-10 md:mt-0">
                <form class="mb-5"
                    action="{{ route('informes.update', ['user' => auth()->user()->usuario, $informeSeleccionado->id]) }}"
                    method="POST">
                    @method('put')
                    @csrf
                    <!-- prevención de ataques cross site request forgery -->
                    <div>
                        <label for="nombre" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                        <input class="border p-3 w-full rounded-lg mb-2 @error('nombre') border-red-500 @enderror"
                            type="text" name="nombre" id="nombre" placeholder="Indica el nombre del informe"
                            value="{{ $informeSeleccionado->nombre }}">
                        <!--podemos llamar al helper error para aplicar una clase en caso de error-->
                        <!-- con el helper old podemos mantener el nombre que ya ha escrito el usuario aunque de error-->
                    </div>
                    @error('nombre')
                        <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
                    @enderror
                    <div>
                        <label for="fecha" class="mb-2 block uppercase text-gray-500 font-bold">Fecha</label>
                        <input class="border p-3 w-full rounded-lg mb-2 @error('fecha') border-red-500 @enderror"
                            type="date" name="fecha" id="fecha" value={{ $informeSeleccionado->fecha }}>
                    </div>
                    @error('fecha')
                        <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="importe" class="mb-2 block uppercase text-gray-500 font-bold">Importe</label>
                        <input readonly class="border p-3 w-full rounded-lg mb-2 @error('importe') border-red-500 @enderror"
                            type="text" name="importe" id="importe" value={{ $informeSeleccionado->importe }}>
                    </div>
                    @error('importe')
                        <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
                    @enderror
                    <input type="submit" value="Actualizar Informe"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </form>

            </div>
        </div>

        <div class="relative overflow-x-1 shadow-md sm:rounded-lg p-20">
        
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                <thead class="text-gray-800 bg-red-400 ">
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Fecha</th>
                    <th scope="col" class="px-6 py-3">Importe</th>
                    <th scope="col" class="px-6 py-3">Quitar</th>

                </thead>

                <tbody>
                    @foreach ($listadoTickets as $item)
                        <tr>
                            <td class="px-6 py-4">{{ $item->tickets_id }}</td>
                            <td class="px-6 py-4">{{ $item->tickets->nombre }}</td>
                            <td class="px-6 py-4">{{ $item->tickets->fecha }}</td>
                            <td class="px-6 py-4">{{ $item->tickets->importe . ' €' }}</td>

                            <td>
                                <form action="{{ route('detalleInforme.quitarTicket', $item->tickets_id) }}" id="eliminarTicket"
                                    method="post">

                             
                                    @csrf
                                    <button title="Quitar" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>

                                    </button>

                                </form>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
  
@endsection
