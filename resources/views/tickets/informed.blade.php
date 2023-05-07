@extends('layouts.app')

@section('titule')
    <div class="container p-3 bg-blue-300 flex justify-center gap-3 ">
        Empleado: {{ $user->nombre . ' ' . $user->apellidos }} . Total de Tickets: {{ $listadoTickets->count() }}
    </div>
@endsection

@section('content')
    <div class="relative overflow-x-1 shadow-md sm:rounded-lg">

        <nav class="flex gap-4 items-center ml-4 mb-4">

            <a href="{{ route('tickets.index', ['user' => auth()->user()->usuario]) }}"
                class="flex items-center gap-2 bg-blue-500 border p-2 mb-3 text-white 
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
                <th scope="col" class="px-6 py-3">Fecha</th>
                <th scope="col" class="px-6 py-3">Foto</th>
                <th scope="col" class="px-6 py-3">Tipo de Gasto</th>
                <th scope="col" class="px-6 py-3">Importe</th>
                <th scope="col" class="px-6 py-3">Estado</th>


            </thead>
            <tbody>
                @foreach ($listadoTickets as $item)
                    <tr>
                        <td class="px-6 py-4">{{ $item->id }}</td>
                        <td class="px-6 py-4">{{ $item->nombre }}</td>
                        <td class="px-6 py-4">{{ $item->fecha }}</td>
                        <td class="px-6 py-4">
                            <img class="imagen" style="cursor:pointer" onclick="abreModalImagen(this)" width="25px" height="25px"
                                src="{{ asset('uploads/' . $item->foto) }}" alt="foto">
                        </td>
                        <td class="px-6 py-4">{{ $item->tipoGasto->nombre }}</td>
                        <td class="px-6 py-4">{{ $item->importe . ' €' }}</td>
                        <td class="px-6 py-4">{{ $item->estado }}</td>



                    </tr>
                @endforeach

            </tbody>
        </table>

        <!-- Modal ampliación imagen-->

        <div id="modalImagen" tabindex="-1"
            class="modal fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                            Ticket
                        </h3>
                        <button type="button" onclick="cierraModalImagen()"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="modalImagen">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="cerrar">Cerrar</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div>
                        <img id="miImagenModal" src="" alt="" width="350px" height="350px">
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script>
        let modal = document.getElementById("modalImagen");

        //funcion para abrir la modal
        function abreModalImagen(elementoImg) {
            let imagenModal = document.getElementById("miImagenModal");
            imagenModal.src = elementoImg.src;
            modal.style.display = 'block';
        }

        // función para cerrar la modal
        function cierraModalImagen() {

            modal.style.display = "none";
        }


        // si el usuario hace click en cualquier lugar cierra la modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    </div>
@endsection
