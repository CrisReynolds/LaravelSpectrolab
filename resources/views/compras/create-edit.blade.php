<div class="fixed inset-0 flex items-center justify-center z-50">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
        <!-- Modal content goes here -->
        <svg wire:click.prevent="$set('isOpen', false)"
            class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
            <path
                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
        </svg>
        <h2 class="text-2xl font-bold mb-4">{{ $compraId ? 'Editar Compra' : 'Registrar Compra' }}</h2>

        <form wire:submit.prevent="{{ $compraId ? 'update' : 'store' }}">
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full group">
                    <label for="fecha_compra" class="block text-gray-700 font-bold mb-2">
                        <span class="text-red-600">*</span>Fecha de compra:</label>
                    <input type="date" wire:model="fecha_compra" id="fecha_compra"
                        class="w-full border border-gray-300 px-4 py-2 rounded">
                    @error('fecha_compra')
                        <div class="mb-4">
                            <small class="text-red-600">{{ 'El dato es requerido' }}</small>
                        </div>
                    @enderror
                </div>
                <div class="relative z-0 w-full group">
                    <label for="fecha_entrega" class="block text-gray-700 font-bold mb-2">Fecha de
                        entrega:</label>
                    <input type="date" wire:model="fecha_entrega" id="fecha_entrega"
                        class="w-full border border-gray-300 px-4 py-2 rounded">
                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full group">
                    <label for="num_factura" class="block text-gray-700 font-bold mb-2"><span class="text-red-600">*</span>
                    Número de factura:</label>
                    <input type="number" wire:model="num_factura" id="num_factura"
                    class="w-full border border-gray-300 px-4 py-2 rounded">
                    @error('num_factura')
                        <div class="mb-4">
                            <small class="text-red-600">{{ 'El dato es requerido' }}</small>
                        </div>
                    @enderror
                </div>
                <div class="relative z-0 w-full group">
                    <label for="num_vale_ingreso" class="block text-gray-700 font-bold mb-2"><span class="text-red-600">*</span>
                        No. de vale de ingreso:</label>
                    <input type="text" wire:model="num_vale_ingreso" id="num_vale_ingreso" placeholder="1/2023"
                        class="w-full border border-gray-300 px-4 py-2 rounded">
                    @error('num_vale_ingreso')
                        <div class="mb-4">
                            <small class="text-red-600">{{ 'Error en el formato' }}</small>
                        </div>
                    @enderror
                </div>
            </div>
            <div class="mb-4">

                <label for="proveedor_id" class="block text-gray-700 font-bold mb-2">
                    <span class="text-red-600">*</span>Proveedor:</label>
                <select wire:model="proveedor_id" id="proveedor_id"
                    class="w-full border border-gray-300 px-4 py-2 rounded">
                    <option value="">Selecciona un proveedor</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
                @error('proveedor_id')
                    <div class="mb-4">
                        <small class="text-red-600">{{ 'El dato es requerido' }}</small>
                    </div>
                @enderror

                {{-- <label for="usuario_id" class="block text-gray-700 font-bold mb-2">Usuario:</label>
                <select wire:model="usuario_id" id="usuario_id" class="w-full border border-gray-300 px-4 py-2 rounded">
                    <option value="">Selecciona un usuario</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>
                @error('usuario_id')
                    <div class="mb-4">
                        <small class="text-red-600">{{ 'Error de usuario' }}</small>
                    </div>
                @enderror --}}
            </div>
            <div class="flex justify-end">

                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Guardar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                    wire:click="closeModal">Cancelar</button>
            </div>
        </form>
    </div>
</div>
