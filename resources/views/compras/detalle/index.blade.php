<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <b class="mb-2 text-sm font-medium text-gray-900">Fecha compra:</b><span
        class="mb-2 text-sm font-medium text-gray-900">{{ $compra->fecha_compra->format('Y-m-d') }}</span><br>
    <b class="mb-2 text-sm font-medium text-gray-900">Fecha entrega:</b><span
        class="mb-2 text-sm font-medium text-gray-900">{{ $compra->fecha_entrega->format('Y-m-d') }}</span><br>
    <b class="mb-2 text-sm font-medium text-gray-900">No Factura:</b><span
        class="mb-2 text-sm font-medium text-gray-900">{{ $compra->num_factura }}</span><br>
    <b class="mb-2 text-sm font-medium text-gray-900">No vale ingreso:</b><span
        class="mb-2 text-sm font-medium text-gray-900">{{ $compra->num_vale_ingreso }}</span><br>
    <b class="mb-2 text-sm font-medium text-gray-900">Proveedor:</b><span
        class="mb-2 text-sm font-medium text-gray-900">{{ $compra->proveedor->nombre }}</span><br>
    <div>
        <h3>Detalle de Consumo</h3>
    </div>
    @include('compras.detalle.create')
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-black uppercase bg-blue-300 dark:bg-gray-700 dark:text-gray-400">

            <th scope="col" class="px-6 py-3">
                Id
            </th>
            <th scope="col" class="px-6 py-3">
                Fecha
            </th>
            <th scope="col" class="px-6 py-3">
                Insumo
            </th>
            <th scope="col" class="px-6 py-3">
                Observaciones
            </th>
            <th scope="col" class="px-6 py-3">
                Cantidad
            </th>
            <th scope="col" class="px-6 py-3">
                Importe
            </th>
            <th scope="col" class="px-6 py-3">
                Precio
            </th>
            <th scope="col" class="px-6 py-3">
                Opciones
            </th>
        </thead>
        <tbody>
            @foreach ($detalles as $compra)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $compra->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $compra->created_at->format('Y-m-d') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $compra->insumo->detalle }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $compra->observacion_insumo }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $compra->cantidad }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $compra->importe }}
                    </td>
                    <td class="px-6 py-4">
                        {{ round($compra->importe / $compra->cantidad, 2) }}
                    </td>
                    <td class="flex items-center px-6 py-4 space-x-3">
                        <button
                            onclick="return confirm('Esta seguro de eliminar este registro?') || event.stopImmediatePropagation()"
                            wire:click="deleteDetalleCompra({{ $compra->id }})"
                            class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        {{-- <a href="" class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center"> <i class="fa-solid fa-trash"></i></a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- {{ $compras->links() }} <!-- Aquí se muestra la paginación --> --}}
</div>
