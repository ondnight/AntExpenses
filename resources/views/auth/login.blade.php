@extends('layouts.app')

@section('titule')

<div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
    Inicia Sesión
    </div>

@endsection

@section('content')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-6/12 p-5">
        <img src="{{ asset('img/login.jpg') }}" alt="login de Usuarios">
    </div>

    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
        <form method="POST" action="{{ route('login') }}" class="mb-5">
            @csrf
            <!-- prevención de ataques cross site request forgery -->

            <!-- desde el logincontroller, al autenticar usuario, si son incorrectas llama al mensaje en el metodo store-->
            @if (session('mensaje'))
                <p class="border p-3 w-full rounded-lg mb-2 border-red-500 ">
                    {{ session('mensaje') }}
                </p>
            @endif
            <div>
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                <input class="border p-3 w-full rounded-lg mb-2 @error('email') border-red-500 @enderror" type="email"
                    name="email" id="email" placeholder="Indica tu email" value={{ old('email') }}>
            </div>
            @error('email')
                <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
            @enderror
            <div>
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                <input class="border p-3 w-full rounded-lg mb-2 @error('password') border-red-500 @enderror"
                    type="password" name="password" id="password" placeholder="Introduce tu password">
            </div>
            @error('password')
                <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
            @enderror

            <div class="mb-5">
                <input type="checkbox" name="remember" id="remember"><label for="remember"
                    class=" text-gray-500">Mantener la sesión abierta</label>
            </div>

            <input type="submit" value="Iniciar sesión"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>

    </div>
</div>
@endsection