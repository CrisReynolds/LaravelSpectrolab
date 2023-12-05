<x-menu>
    <div class="p-2 sm:px-20 bg-white border-b border-gray-200">
        <div class="mt-4 text-2xl">
            <div>Inventario</div>
        </div>
        <div class="mt-3">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">
                            <div class="flex-items-center">Id</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-items-center">Fecha</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-items-center">Cantidad</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-items-center">Unidad</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-items-center">Detalle</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-items-center">Marca</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-items-center">Código</div>
                        </th>
                        <th class="px-4 py-2">
                            <div class="flex-items-center">Precio</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($insumos as $insumo)
                        <tr>
                            <td class="border px-4 py-2">{{ $insumo->id }}</td>
                            <td class="border px-4 py-2">{{ $insumo->fecha }}</td>
                            <td class="border px-4 py-2">{{ $insumo->cantidad }}</td>
                            <td class="border px-4 py-2">{{ $insumo->unidad }}</td>
                            <td class="border px-4 py-2">{{ $insumo->detalle }}</td>
                            <td class="border px-4 py-2">{{ $insumo->marca }}</td>
                            <td class="border px-4 py-2">{{ $insumo->codigo }}</td>
                            <td class="border px-4 py-2">{{ $insumo->precio }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>   
    <div>{{$insumos->links()}}</div>
</x-menu>