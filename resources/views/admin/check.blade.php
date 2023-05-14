@extends('layouts.admin')

@section('titule')
    <div>
        Administrador: {{ $user->nombre . ' ' . $user->apellidos }} . Informe: {{ $informe->id }}
    </div>
@endsection

@section('content')
    <div class="relative overflow-x-1 shadow-md sm:rounded-lg">



        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
            <thead class="text-gray-800 bg-red-400 ">
                <th scope="col" class="px-6 py-3">Id</th>
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Empleado</th>
                <th scope="col" class="px-6 py-3">Fecha</th>
                <th scope="col" class="px-6 py-3">Importe</th>
                <th scope="col" class="px-6 py-3">Estado</th>
                <th scope="col" class="px-6 py-3">Revision</th>

            </thead>
            <tbody>

                <tr>
                    <td class="px-6 py-4">{{ $informe->id }}</td>
                    <td class="px-6 py-4">{{ $informe->nombre }}</td>
                    <td class="px-6 py-4">{{ $informe->user->nombre . ' ' . $informe->user->apellidos }}</td>
                    <td class="px-6 py-4">{{ $informe->fecha }}</td>
                    <td class="px-6 py-4">{{ $informe->importe . ' €' }}</td>
                    <td class="px-6 py-4">{{ $informe->estado }}</td>
                    <td class="px-6 py-4">{{ $informe->revision }}</td>

                </tr>

            </tbody>
        </table>
    </div>

    <form action="{{ route('admin.check', ['user' => auth()->user()->usuario, 'informe' => $informe->id]) }}" method="post"
        id="guardarInforme" >

        @method('put')
        @csrf

        <div class="md:flex md:justify-center md:gap-4 md:items-center md:p-10">


            <label for="observaciones" class="mb-2 block uppercase text-gray-500 font-bold">Observaciones</label>
            <input class="border p-3 w-full rounded-lg mb-2 @error('observaciones') border-red-500 @enderror"
                type="textarea" name="observaciones" id="observaciones" placeholder="Indica las observaciones"
                value="">
            @error('observaciones')
                <p class="text-red-500 my-2 rounded-lg text-sm p-2 text-center-left">{{ $message }}</p>
            @enderror

            <div class="flex items-center mb-4">
                <input required id="accept" type="radio" value="accept" name="radio"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="accept" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Aceptar</label>
            </div>

            <div class="flex items-center mb-4">
                <input required id="reject" type="radio" value="reject" name="radio"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="reject" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Rechazar</label>
            </div>

        </div>

        <div>

            <nav class="flex items-center ml-10">
                <input type="submit" value="Guardar" onclick="return confirm('¿Esta seguro de que desea finalizar la evaluación?');"
                    class="guardar bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold m-3 p-3 text-white rounded-lg">

                <a href="{{ route('admin.pending', ['user' => auth()->user()->usuario]) }}"
                    class="bg-red-600 hover:bg-red-700 transition-colors cursor-pointer uppercase font-bold m-3 p-3 text-white rounded-lg">

                    Volver</a>
            </nav>
        </div>

    </form>

 
@endsection
