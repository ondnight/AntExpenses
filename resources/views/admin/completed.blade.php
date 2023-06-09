@extends('layouts.admin')

@section('titule')
    <div>
        Administrador: {{ $user->nombre . ' ' . $user->apellidos }} Nº Informes Pendientes: {{$listadoInformes->count()}}
    </div>
@endsection

@section('content')
    <div class="relative overflow-x-1 shadow-md sm:rounded-lg">

        <nav class="flex gap-4 items-center ml-4 mb-4">
            <a href="{{ route('admin.pending', ['user' => auth()->user()->usuario]) }}"
                class=" flex items-center gap-2 bg-blue-500 border hover:bg-blue-700 p-2 mb-3 text-white 
        rounded text-sm uppercase font-bold cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                </svg>
                Informes Pendientes</a>
            <a href="{{ route('admin.completed', ['user' => auth()->user()->usuario]) }}"
                class=" flex items-center gap-2 bg-blue-500 hover:bg-blue-700 border p-2 mb-3 text-white 
        rounded text-sm uppercase font-bold cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                </svg>

                Informes Completados</a>
            <a href="{{ route('admin.index', ['user' => auth()->user()->usuario]) }}"
                class="flex items-center gap-2 bg-red-500 hover:bg-red-700 border p-2 mb-3 text-white 
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
                <th scope="col" class="px-6 py-3">Empleado</th>
                <th scope="col" class="px-6 py-3">Fecha</th>
                <th scope="col" class="px-6 py-3">Importe</th>
                <th scope="col" class="px-6 py-3">Estado</th>
                <th scope="col" class="px-6 py-3">Revision</th>
                <th scope="col" class="px-6 py-3">Observaciones</th>
                

            </thead>
            <tbody>
                @foreach ($listadoInformes as $item)
                    <tr>
                        <td class="px-6 py-4">{{ $item->id }}</td>
                        <td class="px-6 py-4">{{ $item->nombre }}</td>
                        <td class="px-6 py-4">{{ $item->user->nombre . ' ' . $item->user->apellidos }}</td>
                        <td class="px-6 py-4">{{ $item->fecha }}</td>
                        <td class="px-6 py-4">{{ $item->importe . ' €' }}</td>
                        <td class="px-6 py-4">{{ $item->estado }}</td>
                        <td class="px-6 py-4">{{ $item->revision }}</td>
                        <td class="px-6 py-4">{{ $item->observaciones }}</td>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div>
        {{$listadoInformes->links('pagination::tailwind')}}
    </div>
@endsection
