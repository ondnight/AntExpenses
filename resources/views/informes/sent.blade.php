@extends('layouts.app')


@section('titule')
<div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
    Empleado: {{ $user->nombre . ' ' . $user->apellidos }} . Total de Informes Enviados: {{ $listadoInformes->count() }}

    <a href="{{ route('informes.index', ['user' => auth()->user()->usuario]) }}"
        class="flex items-center gap-2 bg-red-500 border p-2 mb-3 ml-5 text-white 
rounded text-sm uppercase font-bold cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
        </svg>

        Volver</a>
</div>

@endsection

@section('content')

<style>
    .revision1 {
        color: black !important;
        font-weight: bold;
    }

    .revision2 {
        color: green !important;
        font-weight: bold;
    }
</style>

<div class="relative overflow-x-1 shadow-md sm:rounded-lg">

    

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
        <thead class="text-gray-800 bg-red-400 ">
            <th scope="col" class="px-6 py-3">Id</th>
            <th scope="col" class="px-6 py-3">Nombre</th>
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
                    <td class="px-6 py-4">{{ $item->fecha }}</td>
                    <td class="px-6 py-4">{{ $item->importe . ' €' }}</td>
                    <td class="px-6 py-4">{{ $item->estado }}</td>
                    @if ($item->revision == 'Pendiente de revisión')
                    <td class="revision1 px-6 py-4">{{$item->revision}}</td>
                    @endif
                    @if ($item->revision == 'Aceptado')
                    <td class="revision2 px-6 py-4">{{$item->revision}}</td>
                    @endif
                    <td class="px-6 py-4">{{ $item->observaciones }}</td>

                </tr>
            @endforeach

        </tbody>
    </table>
</div>

<div>
    {{$listadoInformes->links('pagination::tailwind')}}
</div>



@endsection