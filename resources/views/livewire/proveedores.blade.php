<div>
    <x-menu>
        <div class="flex justify-center items-center">
            <h2 class="text-4xl font-bold dark:text-black">Proveedores</h2>
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
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click="create">Agregar Proveedor</button>
                <label for="">Buscar:</label>
                <input type="text" wire:model="search" wire:keydown.enter="busqueda"
                class="w-96 border border-gray-300 px-4 py-2 rounded" placeholder="Escribe el proveedor que quieras buscar">
            </div>
            @if($isOpen)
            <div class="fixed inset-0 flex items-center justify-center z-50">
                <div class=" absolute inset-0 bg-black opacity-50"></div>
                <div class=" relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
                    <!-- Modal content goes here -->
                    <svg wire:click.prevent="$set('isOpen', false)"
                    class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                    </svg>
                <h2 class="text-2xl font-bold mb-4">{{ $ProveedorId ? 'Editar Proveedor' : 'Crear Proveedor' }}</h2>
                <form wire:submit.prevent="{{ $ProveedorId ? 'update' : 'store' }}">
                    <div class="grid md:grid-cols-2 md:gap-6 mb-2">
                        <div class="relative z-0 w-full group">
                            <label for="nombre" class="block text-gray-700 font-bold mb-2">
                                <span class="text-red-600">*</span>Nombre del Proveedor:</label>
                            <input type="text" wire:model="nombre" id="nombre" class="w-full border border-gray-300 px-4 py-2 rounded">
                            @error('nombre')
                            <div class="mb-4">
                                <small class="text-red-600">{{$message}}</small>
                            </div>
                            @enderror
                        </div>  
                        <div class="relative z-0 w-full group">      
                            <label for="ciudad" class="block text-gray-700 font-bold mb-2">Ciudad:</label>
                            <select wire:model="ciudad" id="ciudad" class="w-full border border-gray-300 px-4 py-2 rounded">
                                <option value="">Selecciona una ciudad</option>
                                <option value="La Paz">La Paz</option>
                                <option value="Oruro">Oruro</option>
                                <option value="Cochabamba">Cochabamba</option>
                                <option value="Potosi">Potosi</option>
                                <option value="Sucre">Sucre</option>
                                <option value="Santa Cruz">Santa Cruz</option>
                                <option value="Tarija">Tarija</option>
                                <option value="Beni">Beni</option>
                                <option value="Pando">Pando</option>
                                <!-- Campo de entrada de texto para la opción personalizada -->
                                <input type="text" wire:model="ciudad" placeholder="Otra ciudad" class="w-full border border-gray-300 px-4 py-2 rounded">
                            </select>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6 mb-2">
                        <div class="relative z-0 w-full group">
                            <label for="correo" class=" text-gray-700 font-bold ">Correo:</label>
                            <input type="email" wire:model="correo" id="correo" 
                            class="w-full border border-gray-300 px-4 py-2 rounded">
                        </div>  
                        <div class="relative z-0 w-full group">
                            <label for="direccion" class=" text-gray-700 font-bold mb-2">Direccion:</label>
                            <input type="text" wire:model="direccion" id="direccion" 
                            class="w-full border border-gray-300 px-4 py-2 rounded">
                        </div>
                    </div>  
                    <div class="grid md:grid-cols-2 md:gap-6 mb-2">
                        <div class="relative z-0 w-full group">
                            <label for="telefono" class="block text-gray-700 font-bold ">Telefono:</label>
                            <input type="text" wire:model="telefono" id="telefono" class="w-full border border-gray-300 px-4 py-2 rounded">
                        </div>
                        <div class="relative z-0 w-full group">
                            <label for="fax" class="block text-gray-700 font-bold ">Fax:</label>
                            <input type="text" wire:model="fax" id="fax" class="w-full border border-gray-300 px-4 py-2 rounded">
                        </div>
                    </div> 
                    <div class="grid md:grid-cols-2 md:gap-6 mb-2">
                        <div class="relative z-0 w-full group">
                            <label for="nit" class="block text-gray-700 font-bold ">
                                <span class="text-red-600">*</span>NIT:</label>
                            <input type="number" wire:model="nit" id="nit" class="w-full border border-gray-300 px-4 py-2 rounded">
                        </div>
                            @error('nit')
                            <div class="mb-4">
                                <small class="text-red-600">{{'El NIT debe ser un numero de 10 digitos'}}</small>
                            </div>
                            @enderror
                        <div class="relative z-0 w-full group">
                            <label for="persona_contacto" class="block text-gray-700 font-bold ">Persona de contacto:</label>
                            <input type="text" wire:model="persona_contacto" id="persona_contacto" class="w-full border border-gray-300 px-4 py-2 rounded">
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6 mb-2">
                        <div class="relative z-0 w-full group">
                            <label for="productos" class="block text-gray-700 font-bold mb-2">
                                <span class="text-red-600">*</span>Productos:</label>
                            <textarea name="productos" wire:model="productos" id="productos" cols="36" rows="4"></textarea>
                        </div>
                            @error('productos')
                            <div class="mb-4">
                                <small class="text-red-600">{{$message}}</small>
                            </div>
                            @enderror
                        <div class="relative z-0 w-full group">
                            <label for="representante" class="block text-gray-700 font-bold mb-2">Representante:</label>
                            <textarea name="representante" wire:model="representante" id="representante" cols="36" rows="4"></textarea>
                        </div>
                    </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Guardar</button>
                            <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" wire:click="closeModal">Cancelar</button>
                        </div>
                    </form>
                    </div>
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
                            Proveedor
                        </th> 
                        <th scope="col" class="px-6 py-3">
                            Ciudad
                        </th> 
                        <th scope="col" class="px-6 py-3">
                            Correo
                        </th> 
                        <th scope="col" class="px-6 py-3">
                            Direccion
                        </th> 
                        <th scope="col" class="px-6 py-3">
                            Telefono
                        </th> 
                        <th scope="col" class="px-6 py-3">
                            Fax
                        </th> 
                        <th scope="col" class="px-6 py-3">
                            NIT
                        </th> 
                        <th scope="col" class="px-6 py-3">
                            Persona de contacto
                        </th> 
                        <th scope="col" class="px-6 py-3">
                            Productos
                        </th> 
                        <th scope="col" class="px-6 py-3">
                            Representante
                        </th> 
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>        
                    </tr>
                </thead>
                <tbody>  
                    @foreach ($proveedores as $proveedor)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$proveedor->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$proveedor->nombre}}
                        </td>
                        <td class="px-6 py-4">
                            {{$proveedor->ciudad}}
                        </td>
                        <td class="px-6 py-4">
                            {{$proveedor->correo}}
                        </td>
                        <td class="px-6 py-4">
                            {{$proveedor->direccion}}
                        </td>
                        <td class="px-6 py-4">
                            {{$proveedor->telefono}}
                        </td>
                        <td class="px-6 py-4">
                            {{$proveedor->fax}}
                        </td>
                        <td class="px-6 py-4">
                            {{$proveedor->nit}}
                        </td>
                        <td class="px-6 py-4">
                            {{$proveedor->persona_contacto}}
                        </td>
                        <td class="px-6 py-4">
                            {{$proveedor->productos}}
                        </td>
                        <td class="px-6 py-4">
                            {{$proveedor->representante}}
                        </td>
                        <td class="flex items-center px-6 py-4 space-x-3">
                            <button wire:click="edit({{ $proveedor->id }})" class="btn bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center"> 
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button onclick="return confirm('Esta seguro de eliminar este registro?') || event.stopImmediatePropagation()" wire:click="deleteUnidad({{$proveedor->id}})" class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            {{-- <a href="" class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center"> <i class="fa-solid fa-trash"></i></a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
            {{ $proveedores->links() }} <!-- Aquí se muestra la paginación -->
        </div>
        <!-- resources/views/auth/login.blade.php -->
        </x-menu>
</div>
