@extends('layouts.app')


@section('titule')
    <div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
        Empleado: {{ $user->nombre . ' ' . $user->apellidos }} . Seleccione tickets a quitar del informe
        
    </div>
@endsection

@section('content')
    <div class="relative overflow-x-1 shadow-md sm:rounded-lg">


        <h2 class="m-4 font-semibold text-gray-900 dark:text-white">Listado de tickets empleado:
            {{ auth()->user()->nombre }}</h2>


        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
            <thead class="text-gray-800 bg-red-400 ">
                <th scope="col" class="px-6 py-3"></th>
                <th scope="col" class="px-6 py-3">Id</th>
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Fecha</th>
                <th scope="col" class="px-6 py-3">Importe</th>

            </thead>
            <tbody>

                <form action="{{ route('informes.quitarticket', ['user' => auth()->user()->usuario, 'informe' => $informe]) }}"
                    method="POST">
                    @csrf
                    @foreach ($listadoTickets as $item)
                        <tr>
                            <td class="px-6 py-4">
                                <!-- importante en el name poner un array, y en el value la id del ticket -->
                                <input id="check" name="tickets[]" type="checkbox" value="{{ $item->id }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded
                         focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700
                          dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            </td>
                            <td class="px-6 py-4">{{ $item->id }}</td>
                            <td class="px-6 py-4">{{ $item->ticket->nombre }}</td>
                            <td class="px-6 py-4">{{ $item->ticket->fecha }}</td>
                            <td class="px-6 py-4">{{ $item->importe . ' €' }}</td>

                        </tr>
                    @endforeach

            </tbody>
        </table>

        <nav class="flex items-center">
            <input type="submit" value="Quitar Tickets"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold ml-10 mt-10 mb-10 p-3 text-white rounded-lg">         
                
                <a href="{{ route('informes.index', ['user' => auth()->user()->usuario]) }}"
                    class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer uppercase font-bold m-3 p-3 text-white rounded-lg">
                    
                    Volver</a>
        </nav>
        </form>

    </div>
@endsection
