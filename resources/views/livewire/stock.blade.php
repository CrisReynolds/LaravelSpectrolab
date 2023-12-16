<div class="relative overflow-x-auto shadow-md sm:rounded-lg">

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
