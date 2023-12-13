<div>
    <x-menu>
        <div class="flex justify-center items-center">
            <h2 class="text-4xl font-bold dark:text-black">Reporte de Compras</h2>
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
        </section>
        <div class="my-4">

            <form wire:submit.prevent="export" class="grid md:grid-cols-5 md:gap-6" autocomplete="off">
                <a href="{{ url('/compras') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >Atrás</a>
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
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Consultar</button>
                </div>

            </form>
            <a wire:click="consultar">Consultar</a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-black uppercase bg-blue-300 dark:bg-gray-700 dark:text-gray-400">

                    <th scope="col" class="px-6 py-3">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cant.
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
                        Codigo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Importe
                    </th>
                    <th scope="col" class="px-6 py-3">
                        P.Unit
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Proveedor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Doc.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        No.Vale
                    </th>
                </thead>
                <tbody>
                    @isset($reporteCompras)


                    @foreach ($reporteCompras as $compra)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $compra->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $compra->fecha_compra }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $compra->detalle }}
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
                    @endisset
                </tbody>
            </table>

            {{-- {{ $compras->links() }} <!-- Aquí se muestra la paginación --> --}}
        </div>

    </x-menu>
</div>
