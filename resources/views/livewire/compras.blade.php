<div>
    <x-menu>
        <div class="flex justify-center items-center">
            <h2 class="text-4xl font-bold dark:text-black">Compras</h2>
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
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click="create">Registrar Compra</button>
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
            <h2 class="text-2xl font-bold mb-4">{{ $compraId ? 'Editar Compra' : 'Registrar Compra' }}</h2>
            <form wire:submit.prevent="{{ $compraId ? 'update' : 'store' }}">
                        <div class="mb-4">
                            <label for="fecha_compra" class="block text-gray-700 font-bold mb-2">Fecha de compra:</label>
                            <input type="date" wire:model="fecha_compra" id="fecha_compra" class="w-full border border-gray-300 px-4 py-2 rounded">
                            <label for="fecha_entrega" class="block text-gray-700 font-bold mb-2">Fecha de entrega:</label>
                            <input type="date" wire:model="fecha_entrega" id="fecha_entrega" class="w-full border border-gray-300 px-4 py-2 rounded">
                            <label for="importe" class="block text-gray-700 font-bold mb-2">Importe:</label>
                            <input type="number" wire:model="importe" id="importe" step="0.01" class="w-full border border-gray-300 px-4 py-2 rounded">
                            <label for="num_factura" class="block text-gray-700 font-bold mb-2">Número de factura:</label>
                            <input type="number" wire:model="num_factura" id="num_factura" class="w-full border border-gray-300 px-4 py-2 rounded">
                            <label for="num_vale_ingreso" class="block text-gray-700 font-bold mb-2">Número de vale de ingreso:</label>
                            <input type="text" wire:model="num_vale_ingreso" id="num_vale_ingreso" placeholder="1/2023" class="w-full border border-gray-300 px-4 py-2 rounded">
                            @error('num_vale_ingreso')
                            <div class="mb-4">
                                <small class="text-red-600">{{'Error en el formato'}}</small>
                            </div>
                            @enderror
                            <label for="proveedor_id" class="block text-gray-700 font-bold mb-2">Proveedor:</label>
                            <select wire:model="proveedor_id" id="proveedor_id" class="w-full border border-gray-300 px-4 py-2 rounded">
                            <option value="">Selecciona un proveedor</option>
                                @foreach ($proveedores as $proveedor)
                                <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                @endforeach
                            </select>
                            <label for="usuario_id" class="block text-gray-700 font-bold mb-2">Usuario:</label>
                            <select wire:model="usuario_id" id="usuario_id" class="w-full border border-gray-300 px-4 py-2 rounded">
                            <option value="">Selecciona un usuario</option>
                                @foreach ($usuarios as $usuario)
                                <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                @endforeach
                            </select>
                            @error('usuario_id')
                            <div class="mb-4">
                                <small class="text-red-600">{{'Error de usuario'}}</small>
                            </div>
                            @enderror
                        </div>
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
                            Fecha de compra
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de entrega
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Importe
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Número de factura
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Número de vale de ingreso
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Proveedor
                        </th>
                        <th scope="col" class="px-6 py-3">
                            
                        </th>  
                        <th>
                            
                        </th>      
                    </tr>
                </thead>
                <tbody>  
                    @foreach ($compras as $compra)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $compra->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $compra->fecha_compra->format('Y-m-d'); }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $compra->fecha_entrega->format('Y-m-d'); }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $compra->importe }} 
                        </td>
                        <td class="px-6 py-4">
                            {{ $compra->num_factura }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $compra->num_vale_ingreso }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $compra->proveedor->nombre }} 
                        </td>
                        <td class="flex items-center px-6 py-4 space-x-3">
                            <button wire:click="edit({{ $compra->id }})" class="btn bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center"> 
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button onclick="return confirm('Esta seguro de eliminar este registro?') || event.stopImmediatePropagation()" wire:click="deleteCompra({{$compra->id}})" class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            {{-- <a href="" class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center"> <i class="fa-solid fa-trash"></i></a> --}}
                        </td>
                        <td>
                            <a href="{{ route('compras.detalle', ['id' => $compra->id]) }}" class="btn bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">Ver detalle</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
            {{-- {{ $compras->links() }} <!-- Aquí se muestra la paginación --> --}}
        </div>
        <!-- resources/views/auth/login.blade.php -->
        </x-menu>
    </div>
        
