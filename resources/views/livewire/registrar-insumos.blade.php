<div>
    <x-menu>
        <div class="flex justify-center items-center">
            <h2 class="text-4xl font-bold dark:text-black">Inventario</h2>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-black uppercase bg-blue-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad
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
                            Precio
                        </th>
                        <th >
                        </th>
                    </tr>
                </thead>
                <tbody>  
                    @foreach ($insumos as $insumo)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$insumo->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{-- {{$insumo->compra->fecha_compra->format('Y-m-d');}} --}}
                        </td>
                        <td class="px-6 py-4">
                            {{$insumo->stock}}
                        </td>
                        <td class="px-6 py-4">
                            {{$insumo->unidad->unidad_ref}}
                        </td>
                        <td class="px-6 py-4">
                            {{$insumo->detalle}}
                        </td>
                        <td class="px-6 py-4">
                            {{$insumo->marca}}
                        </td>
                        <td class="px-6 py-4">
                            {{$insumo->codigo}}
                        </td>
                        <td class="px-6 py-4">
                            {{$insumo->precio}}
                        </td>
                        <td class="flex items-center px-6 py-4 space-x-3">
                            <button class="btn bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center"> 
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button onclick="return confirm('Esta seguro de eliminar este registro?') || event.stopImmediatePropagation()" wire:click="deleteInsumo({{$insumo->id}})" class="btn bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
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
        @if (session('success'))
        <div class="relative flex flex-col sm:flex-row sm:items-center bg-green-400 dark:bg-green-700 shadow rounded-md py-5 pl-6 pr-8 sm:pr-6 mb-3 mt-3">
            <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                <div class="text-green-500" dark:text-gray-500>
                    <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="text-sm font-medium ml-3">Exito!.</div>
            </div>
            <div class="text-sm tracking-wide text-gray-500 dark:text-white mt-4 sm:mt-0 sm:ml-4"> {{ session('success') }}</div>
            <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
        </div>
        @endif
        </x-menu>   
</div>