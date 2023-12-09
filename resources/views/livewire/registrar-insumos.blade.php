<div>
    <x-menu>
        <div class="flex justify-center items-center">
            <h2 class="text-4xl font-bold dark:text-black">Materias primas, materiales y suministros</h2>
        </div>
        <section>
            @if (session('success'))
                <div
                    class="relative flex flex-col sm:flex-row sm:items-center bg-green-400 dark:bg-green-700 shadow rounded-md py-5 pl-6 pr-8 sm:pr-6 mb-3 mt-3">
                    <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                        <div class="text-green-500" dark:text-gray-500>
                            <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-sm font-medium ml-3">Exito!.</div>
                    </div>
                    <div class="text-sm tracking-wide text-gray-500 dark:text-white mt-4 sm:mt-0 sm:ml-4">
                        {{ session('success') }}</div>
                    <div
                        class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>
            @endif
            <div class="my-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    wire:click="create">Agregar Artículo</button>
            </div>
            @if ($isOpen)
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
                        <h2 class="text-2xl font-bold mb-4">{{ $insumoId ? 'Editar Artículo' : 'Crear Artículo' }}</h2>
                        <form wire:submit.prevent="{{ $insumoId ? 'update' : 'store' }}" autocomplete="off">
                            <div class="mb-1">
                                <label for="detalle" class="block text-gray-700 font-bold">
                                    <span class="text-red-600">*</span>Nombre del artículo:
                                </label>
                                <input type="text" wire:model="detalle" id="detalle"
                                    class=" w-full border border-gray-300 px-4 py-2 rounded">
                            </div>
                                @error('detalle')
                                    <div class="mb-2">
                                        <small class="text-red-600">{{ 'El campo es requerido' }}</small>
                                    </div>
                                @enderror
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full group">
                                    <label for="codigo" class=" text-gray-700 font-bold mb-2">Código:</label>
                                    <input type="text" wire:model="codigo" id="codigo"
                                        class=" w-full mb-2 border border-gray-300 px-4 py-2 rounded">
                                </div>
                                <div class="relative z-0 w-full group">
                                    <label for="marca" class=" text-gray-700 font-bold mb-2 ">Marca:</label>
                                    <input type="text" wire:model="marca" id="marca"
                                            class=" w-full mb-2 border border-gray-300 px-4 py-2 rounded">
                                </div>
                            </div>
                                {{-- <label for="precio" class="w-20 text-gray-700 font-bold mb-2">Precio:</label>
                            <input type="number" step="0.01" wire:model="precio" id="precio" class=" w-1/3 mb-2 border border-gray-300 px-4 py-2 rounded">
                                @error('precio')
                                    <div class="mb-4">
                                        <small class="text-red-600">{{'El precio es requerido'}}</small>
                                    </div>
                                @enderror --}}
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full group">
                                    <label for="unidad_id" class=" text-gray-700 font-bold mb-2">
                                        <span class="text-red-600">*</span>Unidad:
                                    </label>
                                    <select wire:model="unidad_id" id="unidad_id"
                                        class=" w-full border border-gray-300 px-4 py-2 rounded">
                                        <option value="">Selecciona una unidad</option>
                                        @foreach ($unidades as $unidad)
                                            <option value="{{ $unidad->id }}">{{ $unidad->unidad_ref }}</option>
                                        @endforeach
                                    </select>
                                    @error('unidad_id')
                                        <div class="mb-4">
                                            <small class="text-red-600">{{ 'La unidad es requerida' }}</small>
                                        </div>
                                    @enderror
                                </div>
                                <div class="relative z-0 w-full group">
                                    <label for="stock_minimo" class=" block text-gray-700 font-bold ">Cantidad
                                        mínima:</label>
                                    <input type="number" wire:model="stock_minimo" id="stock_minimo"
                                        class=" w-full border mb-2 border-gray-300 px-4 py-2 rounde">
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6 mb-2">
                                <div class="relative z-0 w-full group">
                                    <label for="categoria_id" class=" text-gray-700 font-bold ">
                                        <span class="text-red-600">*</span>Categoria:
                                    </label>
                                    <select wire:model="categoria_id" id="categoria_id"
                                        class="w-full border border-gray-300 px-4 py-2 rounded">
                                        <option value="">Selecciona una Categoría</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->cat_ref }}</option>
                                        @endforeach
                                    </select>
                                    @error('categoria_id')
                                        <div class="mb-2">
                                            <small class="text-red-600">{{ 'La categoria es requerida' }}</small>
                                        </div>
                                    @enderror
                                </div>
                                <div class="relative z-0 w-full group">
                                    <label for="proveedor_id" class=" text-gray-700 font-bold mb-2">
                                        <span class="text-red-600">*</span>Proveedor:
                                    </label>
                                    <select wire:model="proveedor_id" id="proveedor_id"
                                        class="w-full border border-gray-300 px-4 py-2 rounded">
                                        <option value="">Selecciona una Proveedor</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('proveedor_id')
                                        <div class="mb-4">
                                            <small class="text-red-600">{{ 'El proveedor es requerido' }}</small>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                                <label for="es_narcotico" class=" w-32 text-gray-700 font-bold mb-2">
                                    Narcotico:
                                </label>
                                <input type="checkbox" wire:model="es_narcotico" id="es_narcotico" value="1"
                                        class=" h-9 w-9 border mb-2 border-gray-300 px-4 py-2 rounded-md ">
                            

                            <div class="flex justify-end">

                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Guardar</button>
                                <button type="button"
                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                    wire:click="closeModal">Cancelar</button>
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
                            Unidad
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Detalle
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Marca
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Código
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categoria
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Proveedor
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($insumos as $insumo)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $insumo->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $insumo->unidad->unidad_ref }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $insumo->detalle }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $insumo->marca }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $insumo->codigo }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $insumo->categoria->cat_ref }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $insumo->proveedor->nombre }}
                            </td>
                            <td class="flex items-center px-6 py-4 space-x-3">
                                <button wire:click="edit({{ $insumo->id }})"
                                    class="btn bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button
                                    onclick="return confirm('Esta seguro de eliminar este registro?') || event.stopImmediatePropagation()"
                                    wire:click="deleteInsumo({{ $insumo->id }})"
                                    class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                {{-- <a href="" class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center"> <i class="fa-solid fa-trash"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $insumos->links() }} <!-- Aquí se muestra la paginación -->
        </div>
    </x-menu>
</div>
