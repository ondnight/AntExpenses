@extends('layouts.app')

@section('titule')
    <div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
        Registra un nuevo informe

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
    Contenido nuevo informe de gastos
@endsection
