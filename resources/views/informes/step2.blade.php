@extends('layouts.app')


@section('titule')
    <div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
        Empleado: {{ $user->nombre . ' ' . $user->apellidos }} . Seleccione tickets a añadir al informe
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
    <div class="relative overflow-x-1 shadow-md sm:rounded-lg">


        <h2 class="mb-4 font-semibold text-gray-900 dark:text-white">Listado de tickets empleado:
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

                <form action="{{ route('informes.step3', ['user' => auth()->user()->usuario, 'informe' => $informe]) }}"
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
                            <td class="px-6 py-4">{{ $item->nombre }}</td>
                            <td class="px-6 py-4">{{ $item->fecha }}</td>
                            <td class="px-6 py-4">{{ $item->importe . ' €' }}</td>

                        </tr>
                    @endforeach

            </tbody>
        </table>

        <input type="submit" value="Añadir Tickets"
            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

        </form>

    </div>
@endsection
