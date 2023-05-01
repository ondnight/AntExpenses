@extends('layouts.app')

@section('titule')
    <div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
        Empleado: {{ $user->nombre . ' ' . $user->apellidos }} . Total de Informes: {{ $listadoInformes->count() }}
    </div>

@endsection

@section('content')
    <div class="relative overflow-x-1 shadow-md sm:rounded-lg">

        <nav class="flex gap-4 items-center ml-4 mb-4">
            <a href="{{ route('informes.create') }}"
                class=" flex items-center gap-2 bg-blue-500 border p-2 mb-3 text-white 
        rounded text-sm uppercase font-bold cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
                Nuevo Informe</a>
            <a href="{{ route('informes.sent', ['user' => auth()->user()->usuario]) }}"
                class=" flex items-center gap-2 bg-blue-500 border p-2 mb-3 text-white 
        rounded text-sm uppercase font-bold cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                </svg>

                Informes Enviados</a>
            <a href="{{ route('posts.index', ['user' => auth()->user()->usuario]) }}"
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
                <th scope="col" class="px-6 py-3">Importe</th>
                <th scope="col" class="px-6 py-3">Estado</th>
                <th scope="col" class="px-6 py-3">Acciones</th>

            </thead>
            <tbody>
                @foreach ($listadoInformes as $item)
                    <tr>
                        <td class="px-6 py-4">{{ $item->id }}</td>
                        <td class="px-6 py-4">{{ $item->nombre }}</td>
                        <td class="px-6 py-4">{{ $item->fecha }}</td>
                        <td class="px-6 py-4">{{ $item->importe . ' €' }}</td>
                        <td class="px-6 py-4">{{ $item->estado }}</td>


                        <td class="px-6 py-4 flex items-center gap-4">
                            <a title="Editar" href="{{ route('informes.edit', $item->id) }}"> <svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>


                            </a>
                            <form action="{{ route('informes.sent', $item->id) }}" id="eliminarTicket" method="post">

                                @method('delete')
                                @csrf
                                <button title="Borrar" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
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
