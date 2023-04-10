@extends('layouts.app')

@section('titule')
    <div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
        Empleado: {{ $user->nombre . ' ' . $user->apellidos }} . Total de Tickets: {{ $listadoTickets->count() }}
    </div>
@endsection

@section('content')

<div class="relative overflow-x-1 shadow-md sm:rounded-lg">

    <nav class="flex gap-4 items-center ml-4 mb-4">
 
        <a href="{{ route('tickets.index', ['user' => auth()->user()->usuario]) }}"
            class="flex items-center gap-2 bg-blue-500 border p-2 mb-3 text-white 
        rounded text-sm uppercase font-bold cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>

            Volver</a>
    </nav>

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
        <thead class="text-gray-800 bg-red-400 ">
            <th scope="col" class="px-6 py-3">Id</th>
            <th scope="col" class="px-6 py-3">Nombre</th>
            <th scope="col" class="px-6 py-3">Fecha</th>
            <th scope="col" class="px-6 py-3">Foto</th>
            <th scope="col" class="px-6 py-3">Tipo de Gasto</th>
            <th scope="col" class="px-6 py-3">Importe</th>
            <th scope="col" class="px-6 py-3">Estado</th>
           

        </thead>
        <tbody>
            @foreach ($listadoTickets as $item)
                <tr>
                    <td class="px-6 py-4">{{ $item->id }}</td>
                    <td class="px-6 py-4">{{ $item->nombre }}</td>
                    <td class="px-6 py-4">{{ $item->fecha }}</td>
                    <td class="px-6 py-4">{{ $item->foto }}</td>
                    <td class="px-6 py-4">{{ $item->tipoGasto->nombre }}</td>
                    <td class="px-6 py-4">{{ $item->importe . ' €' }}</td>
                    <td class="px-6 py-4">{{ $item->estado }}</td>


                   
                </tr>
            @endforeach

        </tbody>
    </table>

</div>




@endsection