@extends('layouts.app')

@section('titule')

<div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
Regístrate en Ant Expenses
</div>

@endsection

@section('content')

<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12 p-5">
        <img src="{{ asset('img/registrate.jpg') }}" alt="Imagen Registro de Usuarios">
    </div>

    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
        <form class="mb-5" action="{{ route('register') }}" method="POST">
            @csrf
            <!-- prevención de ataques cross site request forgery -->
            <div>
                <label for="nombre" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                <input class="border p-3 w-full rounded-lg mb-2 @error('nombre') border-red-500 @enderror" type="text"
                    name="nombre" id="nombre" placeholder="Indica tu nombre" value={{ old('nombre') }}>
                <!--podemos llamar al helper error para aplicar una clase en caso de error-->
                <!-- con el helper old podemos mantener el nombre que ya ha escrito el usuario aunque de error-->
            </div>
            @error('nombre')
                <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
            @enderror
            <div>
                <label for="apellidos" class="mb-2 block uppercase text-gray-500 font-bold">Apellidos</label>
                <input class="border p-3 w-full rounded-lg mb-2 @error('apellidos') border-red-500 @enderror" type="text"
                    name="apellidos" id="apellidos" placeholder="Indica tus apellidos" value={{ old('apellidos') }}>
            </div>
            @error('apellidos')
                <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
            @enderror
            
            <div>
                <label for="usuario" class="mb-2 block uppercase text-gray-500 font-bold">Nombre de Usuario</label>
                <input class="border p-3 w-full rounded-lg mb-2 @error('usuario') border-red-500 @enderror" type="text" name="usuario" id="usuario"
                    placeholder="Indica tu nombre de usuario" value={{ old('usuario') }}>
            </div>
            @error('usuario')
                <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
            @enderror
            
            <div>
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                <input class="border p-3 w-full rounded-lg mb-2 @error('email') border-red-500 @enderror" type="email" name="email" id="email"
                    placeholder="Indica tu email" value={{ old('email') }}>
            </div>
            @error('email')
                <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
            @enderror
            <div>
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                <input class="border p-3 w-full rounded-lg mb-2 @error('password') border-red-500 @enderror" type="password" name="password" id="password"
                    placeholder="Introduce tu password">
            </div>
            @error('password')
                <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
            @enderror
            <div>
                <label for="password_confirmation"
                    class="mb-2 block uppercase text-gray-500 font-bold">Repetir Password</label>
                <input class="border p-3 w-full rounded-lg mb-2 " type="password" name="password_confirmation"
                    id="password_confirmation" placeholder="Repite tu password">
            </div>
            <div>
                <label for="codigoAdministrador"
                    class="mb-2 block uppercase text-gray-500 font-bold">¿Eres supervisor?</label>
                <input class="border p-3 w-full rounded-lg mb-2 " type="text" name="codigoAdministrador"
                    id="codigoAdministrador" placeholder="Introduce tu código de alta como supervisor">
            </div>
            <input type="submit" value="Crear Cuenta"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>

    </div>
</div>

@endsection