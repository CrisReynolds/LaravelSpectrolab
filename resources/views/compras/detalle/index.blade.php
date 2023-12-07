<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <strong>Fecha compra:</strong><span>{{ $objCompra->fecha_compra->format('Y-m-d') }}</span><br>
    <strong>Fecha entrega:</strong><span>{{ $objCompra->fecha_entrega->format('Y-m-d') }}</span><br>
    <strong>Importe:</strong><span>{{ $objCompra->importe }}</span><br>
    <strong>No Factura:</strong><span>{{ $objCompra->num_factura }}</span><br>
    <strong>No vale ingreso:</strong><span>{{ $objCompra->num_vale_ingreso }}</span><br>
    <strong>Proveedor:</strong><span>{{ $objCompra->proveedor->nombre }}</span><br>
    <div>
        <h3>Detalle de Compras</h3>
    </div>
    <form wire:submit.prevent="storeDetalleCompra" autocomplete="off">
        <input wire:model="compras_id" type="text" id="compras_id" value=" {{$objCompra->id}} " required>
        @error('compras_id')
            <small>{{ $message }}</small>
        @enderror
        <select wire:model="insumo_id" id="insumo_id">
            <option value="">---Seleccione Insumo--</option>
            @foreach ($objInsumos as $insumo)
                <option value="{{$insumo->id}}">{{$insumo->detalle}}</option>
            @endforeach
        </select>
        @error('insumo_id')
            <small>{{ $message }}</small>
        @enderror
        <input type="number" wire:model="cantidad" id="cantidad">
        @error('cantidad')
            <small>{{ $message }}</small>
        @enderror
        <input type="text" wire:model="observacion_insumo" id="observacion_insumo">
        @error('observacion_insumo')
            <small>{{ $message }}</small>
        @enderror

        <button type="submit">Agregar</button>
    </form>
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
                Precio
            </th>
            <th scope="col" class="px-6 py-3">
                Subtotal
            </th>
            <th scope="col" class="px-6 py-3">
                Opciones
            </th>
        </thead>
        <tbody>
            @foreach ($objDetalleCompra as $compra)
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
                        {{ $compra->insumo->precio }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $compra->cantidad*$compra->insumo->precio }}
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
