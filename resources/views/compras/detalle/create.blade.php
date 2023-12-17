<form wire:submit.prevent="storeDetalleCompra({{$compra->id}})" class="grid md:grid-cols-5 md:gap-6" autocomplete="off">
    <div>
        <label for="insumo_id" class="block mb-2 text-sm font-medium text-gray-900">--Seleccione un insumo<span
                class="text-red-600">*</span><a href="{{url('/inventario')}}"> +</a></label>
        <select wire:model="insumo_id" id="insumo_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">>
            <option value="">---Seleccione Insumo--</option>
            @foreach ($insumos as $insumo)
                <option value="{{ $insumo->id }}">{{ $insumo->detalle }}</option>
            @endforeach
        </select>

        @error('insumo_id')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div>
        <label for="cantidad" class="block mb-2 text-sm font-medium text-gray-900">Cantidad <span
                class="text-red-600">*</span></label>
        <input type="text" wire:model="cantidad" id="cantidad"
            class="dark:text-white block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @error('cantidad')
            <small>{{ $message }}</small>
        @enderror

    </div>
    <div>
        <label for="importe" class="block mb-2 text-sm font-medium text-gray-900">Importe <span
                class="text-red-600">*</span></label>
        <input type="number" wire:model="importe" id="importe"
            class="dark:text-white block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @error('importe')
            <small>{{ $message }}</small>
        @enderror

    </div>
    <div>
        <label for="observacion_insumo" class="block mb-2 text-sm font-medium text-gray-900">Observaciones</label>
        <input type="text" wire:model="observacion_insumo" id="observacion_insumo"
            class="dark:text-white block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @error('observacion_insumo')
            <small>{{ $message }}</small>
        @enderror

    </div>
    <div class="mt-5">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Agregar</button>
    </div>

</form>
