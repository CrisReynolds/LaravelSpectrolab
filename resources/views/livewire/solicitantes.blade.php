<div>
    <div>
        <x-menu>
            <div class="flex justify-center items-center">
                <h2 class="text-4xl font-bold dark:text-black">Solicitantes</h2>
            </div>
            <section>
                @if (session('success'))
            <div class="relative flex flex-col sm:flex-row sm:items-center bg-green-400 dark:bg-green-700 shadow rounded-md py-5 pl-6 pr-8 sm:pr-6 mb-3 mt-3">
                <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                    <div class="text-green-500" dark:text-gray-500>
                        <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                <div class="text-sm font-medium ml-3">Exito!.</div>
            </div>
            <div class="text-sm tracking-wide text-gray-500 dark:text-white mt-4 sm:mt-0 sm:ml-4"> {{ session('success') }}</div>
                <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
            </div>
                @endif
                <div class="my-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click="create">Agregar Solicitante</button>
                    <input type="text" wire:model="search" wire:keydown.enter="busqueda"
                    class="w-96 border border-gray-300 px-4 py-2 rounded" placeholder="Escribe el solicitante que quieras buscar">
                </div>
                @if($isOpen)
                <div class="fixed inset-0 flex items-center justify-center z-50">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
                        <!-- Modal content goes here -->
                        <svg wire:click.prevent="$set('isOpen', false)"
                        class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                </svg>
                <h2 class="text-2xl font-bold mb-4">{{ $solicitanteId ? 'Editar Solicitante' : 'Crear Solicitante' }}</h2>
                <form wire:submit.prevent="{{ $solicitanteId ? 'update' : 'store' }}">
                            <div class="mb-4">
                                <label for="solicitante_ref" class="block text-gray-700 font-bold mb-2">Nombre del solicitante:</label>
                                <input type="text" wire:model="solicitante_ref" id="solicitante_ref" class="w-full border border-gray-300 px-4 py-2 rounded">
                            </div>
        
                            @error('solicitante_ref')
                                <div class="mb-4">
                                    <small class="text-red-600">{{'El campo es requerido y debe tener más de 3 caracteres'}}</small>
                                </div>
                                
                            @enderror
                            <div class="flex justify-end">
        
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Guardar</button>
                                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" wire:click="closeModal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </section>
            
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-black uppercase bg-blue-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Solicitante
                            </th> 
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>        
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach ($solicitantes as $solicitante)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$solicitante->id}}
                            </th>
                            <td class="px-6 py-4">
                                {{$solicitante->solicitante_ref}}
                            </td>
                            <td class="flex items-center px-6 py-4 space-x-3">
                                <button wire:click="edit({{ $solicitante->id }})" class="btn bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center"> 
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button onclick="return confirm('Esta seguro de eliminar este registro?') || event.stopImmediatePropagation()" wire:click="deleteUnidad({{$solicitante->id}})" class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                {{-- <a href="" class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center"> <i class="fa-solid fa-trash"></i></a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        
                {{ $solicitantes->links() }} <!-- Aquí se muestra la paginación -->
            </div>
            <!-- resources/views/auth/login.blade.php -->
            </x-menu>
        </div>
</div>
