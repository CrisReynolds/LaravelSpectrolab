<div>
    <x-menu>
        <div class="flex justify-center items-center">
            <h2 class="text-4xl font-bold dark:text-black">Consumos</h2>
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
                <form wire:submit.prevent="export" class="grid md:grid-cols-5 md:gap-6" autocomplete="off">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    wire:click="create">Registrar Consumo</button>
                    <div class="mt-1">
                        <input type="date" wire:model="start_date" id="start_date"
                            class="dark:text-white block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        @error('start_date')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mt-1">
                        <input type="date" wire:model="end_date" id="end_date"
                            class="dark:text-white block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        @error('end_date')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mt-0">
                        <button type="submit"
                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Exportar</button>
                    </div>

                </form>
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
                        <h2 class="text-2xl font-bold mb-4">{{ $consumoId ? 'Editar Consumo' : 'Regisrar Consumo' }}
                        </h2>
                        <form wire:submit.prevent="{{ $consumoId ? 'update' : 'store' }}">
                            <div class="grid md:grid-cols-2 md:gap-6 mb-2">
                                <div class="relative z-0 w-full group">
                                    <label for="fecha_consumo" class="block text-gray-700 font-bold mb-2">
                                        <span class="text-red-600">*</span>Fecha Consumo:</label>
                                    <input type="date" wire:model="fecha_consumo" id="fecha_consumo"
                                        class="w-full border border-gray-300 px-4 py-2 rounded">
                                    @error('fecha_consumo')
                                        <div class="mb-4">
                                            <small class="text-red-600">{{ 'El dato es requerido' }}</small>
                                        </div>
                                    @enderror
                                </div>
                                <div class="relative z-0 w-full group">
                                    <label for="num_vale_salida" class="block text-gray-700 font-bold mb-2">
                                        <span class="text-red-600">*</span>Número de vale de salida:</label>
                                    <input type="number" wire:model="num_vale_salida" id="num_vale_salida"
                                        class="w-full border border-gray-300 px-4 py-2 rounded">
                                    @error('num_vale_salida')
                                        <div class="mb-4">
                                            <small class="text-red-600">{{ 'El dato es requerido' }}</small>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6 mb-2">
                                <div class="relative z-0 w-full group">
                                    <label for="observaciones"
                                        class="block text-gray-700 font-bold mb-2">Observaciones:</label>
                                    <input type="text" wire:model="observaciones" id="observaciones"
                                        class="w-full border border-gray-300 px-4 py-2 rounded">
                                </div>
                                <div class="relative z-0 w-full group">
                                    <label for="parametro" class="block text-gray-700 font-bold mb-2">Parámetro:</label>
                                    <input type="text" wire:model="parametro" id="parametro"
                                        class="w-full border border-gray-300 px-4 py-2 rounded">
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6 mb-2">
                                <div class="relative z-0 w-full group">
                                    <label for="descripcion"
                                        class="block text-gray-700 font-bold mb-2">Descripcion:</label>
                                    <input type="text" wire:model="descripcion" id="descripcion"
                                        class="w-full border border-gray-300 px-4 py-2 rounded">
                                </div>
                                <div class="relative z-0 w-full group">
                                    <label for="solicitante_id" class="block text-gray-700 font-bold mb-2">
                                        <span class="text-red-600">*</span>Solicitante:</label>
                                    <select wire:model="solicitante_id" id="solicitante_id"
                                        class="w-full border border-gray-300 px-4 py-2 rounded">
                                        <option value="">Selecciona un solicitante</option>
                                        @foreach ($solicitantes as $solicitante)
                                            <option value="{{ $solicitante->id }}">{{ $solicitante->solicitante_ref }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('solcitante_id')
                                        <div class="mb-4">
                                            <small class="text-red-600">{{ 'El dato es requerido' }}</small>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <label for="usuario_id" class="block text-gray-700 font-bold mb-2">Usuario:</label>
                                <select wire:model="usuario_id" id="usuario_id" class="w-full border border-gray-300 px-4 py-2 rounded">
                                <option value="">Selecciona un usuario</option>
                                    @foreach ($usuarios as $usuario)
                                    <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                    @endforeach
                                </select> --}}
                            @error('usuario_id')
                                <div class="mb-4">
                                    <small class="text-red-600">{{ 'El dato es requerido' }}</small>
                                </div>
                            @enderror

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
                            Fecha Consumo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Numero de vale de salida
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Observaciones
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Parametro
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Descripcion
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Solicitante
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consumos as $consumo)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $consumo->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $consumo->fecha_consumo->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $consumo->num_vale_salida }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $consumo->observaciones }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $consumo->parametro }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $consumo->descripcion }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $consumo->solicitante->solicitante_ref }}
                            </td>

                            <td class="flex items-center px-6 py-4 space-x-3">
                                <button wire:click="edit({{ $consumo->id }})"
                                    class="btn bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button
                                    onclick="return confirm('Esta seguro de eliminar este registro?') || event.stopImmediatePropagation()"
                                    wire:click="deleteConsumo({{ $consumo->id }})"
                                    class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                {{-- <a href="" class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center"> <i class="fa-solid fa-trash"></i></a> --}}
                            <td>
                                <a href="{{ route('consumo.detalle', $consumo->id) }}"
                                    class="btn bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">Ver
                                    detalle</a>
                            </td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $consumos->links() }} <!-- Aquí se muestra la paginación -->
        </div>
        <!-- resources/views/auth/login.blade.php -->
    </x-menu>
</div>
