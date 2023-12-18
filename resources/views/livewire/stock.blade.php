<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
<div class="my-4">

            <form wire:submit.prevent="consultar" class="grid md:grid-cols-5 md:gap-6" autocomplete="off">
                <div class="mt-1">
                    <input type="date" wire:model="start_date" id="start_date"
                        class="dark:text-white block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                    @error('start_date')
                        <small>{{ $message }}</small>
                    @enderror

                </div>
                <div class="mt-1">
                    <input type="date" wire:model="end_date" id="end_date"
                        class="dark:text-white block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                    @error('end_date')
                        <small>{{ $message }}</small>
                    @enderror

                </div>
                <div class="mt-0">
                    <button type="submit"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Consultar</button>
                </div>
                <a wire:click="export"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                    >Exportar</a>
            </form>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-black uppercase bg-blue-300 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        FECHA
                    </th>
                    <th scope="col" class="px-6 py-3">
                        CANT
                    </th>
                    <th scope="col" class="px-6 py-3">
                        UNIDAD
                    </th>
                    <th scope="col" class="px-6 py-3">
                        DETALLE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        MARCA
                    </th>
                    <th scope="col" class="px-6 py-3">
                        CODIGO
                    </th>
                    <th scope="col" class="px-6 py-3">
                        PRECIO EN ALMACEN
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- @if (count($inventario) >= 0)
                @foreach ($inventario as $key => $stock)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ $key }}
                        </td>
                        <td class="px-6 py-4">
                            {{$stock}}
                        </td>
                    </tr>
                @endforeach
                @else
                No hay stock
                @endif --}}
                @foreach ($inventario as $stock)


                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $stock->created_at }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $stock->cantidad }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $stock->unidad_ref }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $stock->detalle }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $stock->marca }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $stock->codigo }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $stock->precio }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $insumos->links() }} --}}
</div>
