@extends('layouts.app')

@section('titule')
    <div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
        Empleado: {{ $user->nombre . ' ' . $user->apellidos }} . Total de Tickets: {{ $listadoTickets->count() }}
    </div>
@endsection

@section('content')
    <div class="relative overflow-x-1 shadow-md sm:rounded-lg">

        <nav class="flex gap-4 items-center ml-4 mb-4">
            <a href="{{ route('tickets.create') }}"
                class=" flex items-center gap-2 bg-blue-500 border p-2 mb-3 text-gray-600 
            rounded text-sm uppercase font-bold cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
                Nuevo Ticket</a>
            <a href="{{ route('posts.index', ['user' => auth()->user()->usuario]) }}"
                class="flex items-center gap-2 bg-blue-500 border p-2 mb-3 text-gray-600 
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
                <th scope="col" class="px-6 py-3">Acciones</th>

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


                        <td class="px-6 py-4 flex items-center gap-4">
                            <a title="Editar" href="{{ route('tickets.edit', $item->id, $item->tipoGasto->nombre) }}"> <svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>


                            </a>

                            <a title="Borrar" href="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>

                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
@endsection
