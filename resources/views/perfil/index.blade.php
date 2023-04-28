@extends('layouts.app')

@section('titule')
    Edición de Empleado: {{ auth()->user()->nombre }}
@endsection

@section('content')
    <div class="container mx-auto bg-gray-500 flex justify-center p-6 place-items-center">

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form class="mb-5" action="/perfil/{{auth()->user()->usuario }}" method="post">
                @csrf
                @method('put')
                

                <!-- prevención de ataques cross site request forgery -->

                <div>
                    <label for="nombre" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input class="border p-3 w-full rounded-lg mb-2 @error('nombre') border-red-500 @enderror" type="text"
                        name="nombre" id="nombre" value="{{ $user->nombre }}">
                </div>
                @error('nombre')
                    <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
                @enderror
                <div>
                    <label for="apellidos" class="mb-2 block uppercase text-gray-500 font-bold">Apellidos</label>
                    <input class="border p-3 w-full rounded-lg mb-2  type="text" name="apellidos" id="apellidos"
                        value="{{ $user->apellidos }}">
                </div>
                @error('apellidos')
                <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
            @enderror
                <div>
                    <label for="usuario" class="mb-2 block uppercase text-gray-500 font-bold">Nombre de Usuario</label>
                    <input class="border p-3 w-full rounded-lg mb-2  type="text" name="usuario" id="usuario"
                        value="{{ $user->usuario }}">
                </div>
                @error('usuario')
                <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
            @enderror
                <div>
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input class="border p-3 w-full rounded-lg mb-2  type="email" name="email" id="email"
                        value="{{ $user->email }}">
                </div>
                @error('email')
                <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
            @enderror

                <input type="submit" value="Actualizar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>

        </div>

    </div>
@endsection
