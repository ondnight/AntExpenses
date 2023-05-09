@extends('layouts.app')

@section('titule')
    Cambiar contraseña

    </nav>
@endsection

@section('content')
    <div class="container mx-auto bg-gray-500 flex justify-center p-6 place-items-center">

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form class="mb-5" action="{{ route('perfil.updatePassword', ['user' => auth()->user()]) }}" method="post">
                @csrf

                <!-- prevención de ataques cross site request forgery -->

                <div>
                    <label for="oldPassword" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña anterior</label>
                    <input class="border p-3 w-full rounded-lg mb-2 @error('oldPassword') border-red-500 @enderror"
                        type="password" name="oldPassword" id="oldPassword" value="">
                </div>
                @error('oldPassword')
                    <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
                @enderror
                <div>
                    <label for="newPassword" class="mb-2 block uppercase text-gray-500 font-bold">Nueva Contraseña</label>
                    <input class="border p-3 w-full rounded-lg mb-2" @error('newPassword') border-red-500 @enderror"
                        type="password" name="newPassword" id="newPassword" value="">
                </div>
                @error('newPassword')
                    <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
                @enderror
                <div>
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirmar
                        contraseña</label>
                    <input class="border p-3 w-full rounded-lg mb-2" type="password" name="password_confirmation"
                        id="password_confirmation" value="">
                </div>


                <nav class="flex items-center">
                    <input type="submit" value="Cambiar contraseña"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold ml-10 mt-10 mb-10 p-3 text-white rounded-lg">         
                        
                        <a href="{{ route('admin.index', ['user' => auth()->user()->usuario]) }}"
                            class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer uppercase font-bold m-3 p-3 text-white rounded-lg">
                            
                            Volver</a>
                </nav>
            </form>

        </div>

    </div>
@endsection
