@extends('layouts.app')

@section('titule')
    <div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
        Edición de Informe nº: {{ $informeSeleccionado->id }}
        
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
                    
                    
                    <nav class="flex items-center">
                        <input type="submit" value="Actualizar Informe"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold ml-10 mt-10 mb-10 p-3 text-white rounded-lg">         
                            
                            <a href="{{ route('informes.index', ['user' => auth()->user()->usuario]) }}"
                                class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer uppercase font-bold m-3 p-3 text-white rounded-lg">
                                
                                Volver</a>
                    </nav>
                
                    </form>

            </div>
        </div>

        
  
@endsection
