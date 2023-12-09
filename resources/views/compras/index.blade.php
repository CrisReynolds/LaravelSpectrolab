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
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $compra->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $compra->fecha_compra->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $compra->fecha_entrega->format('d-m-Y') }}
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
                                <button wire:click="edit({{ $compra->id }})"
                                    class="btn bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button
                                    onclick="return confirm('Esta seguro de eliminar este registro?') || event.stopImmediatePropagation()"
                                    wire:click="deleteCompra({{ $compra->id }})"
                                    class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                {{-- <a href="" class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center"> <i class="fa-solid fa-trash"></i></a> --}}
                            </td>
                            <td>
                                <button type="button" wire:click="detalleCompra({{$compra->id}})" class="btn bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">Ver
                                    detalle</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- {{ $compras->links() }} <!-- Aquí se muestra la paginación --> --}}
        </div>
