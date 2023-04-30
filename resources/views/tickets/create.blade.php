@extends('layouts.app')

@section('titule')
    <div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
        <p>
            Registra un nuevo ticket
        </p>

        <a href="{{ route('tickets.index', ['user' => auth()->user()->usuario]) }}"
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
            <img src="{{ asset('img/tickets.jpeg') }}" alt="Imagen tickets">
        </div>

        <div class="md:w-4/12 bg-white p-10 rounded-lg shadow-xl mt-10 md:mt-0">
            <form class="mb-5" action="{{ route('tickets.store', ['user' => auth()->user()->usuario]) }}"
                enctype="multipart/form-data" method="POST">
                @csrf
                <!-- prevención de ataques cross site request forgery -->
                <div>
                    <label for="nombre" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input class="border p-3 w-full rounded-lg mb-2 @error('nombre') border-red-500 @enderror"
                        type="text" name="nombre" id="nombre" placeholder="Indica el nombre del ticket"
                        value={{ old('nombre') }}>
                    <!--podemos llamar al helper error para aplicar una clase en caso de error-->
                    <!-- con el helper old podemos mantener el nombre que ya ha escrito el usuario aunque de error-->
                </div>
                @error('nombre')
                    <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
                @enderror
                <div>
                    <label for="fecha" class="mb-2 block uppercase text-gray-500 font-bold">Fecha</label>
                    <input class="border p-3 w-full rounded-lg mb-2 @error('fecha') border-red-500 @enderror" type="date"
                        name="fecha" id="fecha" value={{ old('fecha') }}>
                </div>
                @error('fecha')
                    <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
                @enderror
                <div>
                    <label for="tipoGasto" class="mb-2 block uppercase text-gray-500 font-bold">Tipo de Gasto</label>

                    <select name="tipoGasto" id="tipoGasto"
                        class=" form-control border p-3 w-full rounded-lg mb-2 @error('tipoGasto') border-red-500 @enderror">

                        <option value="">--Seleccione un tipo de gasto--</option>
                        @foreach ($tipogasto as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }} </option>
                        @endforeach
                    </select>

                </div>
                @error('tipoGasto')
                    <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
                @enderror

                <div>
                    <label for="foto" class="mb-2 block uppercase text-gray-500 font-bold">Foto</label>
                    <input class="border p-3 w-full rounded-lg mb-2 @error('foto') border-red-500 @enderror" type="file"
                        name="foto" id="foto" value="">
                </div>
                @error('foto')
                    <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
                @enderror
                <div>
                    <label for="importe" class="mb-2 block uppercase text-gray-500 font-bold">Importe</label>
                    <input class="border p-3 w-full rounded-lg mb-2 @error('importe') border-red-500 @enderror"
                        type="number" step="0.01" name="importe" id="importe" placeholder="Indica el importe"
                        value={{ old('importe') }}>
                </div>
                @error('importe')
                    <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
                @enderror

                <input type="submit" value="Crear Ticket"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>

        </div>
    </div>
@endsection
