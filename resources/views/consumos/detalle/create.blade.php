
<form wire:submit.prevent="storeDetalleConsumo({{$miConsumo->id}})" class="grid md:grid-cols-5 md:gap-6" autocomplete="off">
    <div>
        <label for="insumo_id" class="block mb-2 text-sm font-medium text-gray-900">--Seleccione un insumo
            <span class="text-red-600">*</span>
        </label>
        <select wire:model="insumo_id" id="insumo_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">>
            <option value="">---Seleccione Insumo--</option>
            @foreach ($insumos as $key => $insumo)
                <option value="{{ $key }}">{{$insumo}}</option>
            @endforeach
        </select>
        @error('insumo_id')
            <small>{{ $message }}</small>
        @enderror
    </div>
    <div>

        <label for="cantidad" class="block mb-2 text-sm font-medium text-gray-900">Cantidad <span
                class="text-red-600">*</span></label>
        <input type="number" wire:model="cantidad" id="cantidad" wire:keydown.enter="searchPosts" wire:click="searchPosts"
            class="dark:text-white block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        @error('cantidad')
            <small>{{ $message }}</small>
        @enderror
        @if ($message = Session::get('verifyOk'))
            <span class="mb-2 text-sm font-medium text-green-600">{{ $message }}</span>
        @endif
        @if ($message = Session::get('verify'))
            <span class="mb-2 text-sm font-medium text-red-600">{{ $message }}</span>
        @endif

    </div>

    <div class="mt-5">
        {{-- @if($btnVerify)
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Verificar</button>
        @endif --}}
        @if($btnSubmit)
            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Agregar</button>
        @endif

    </div>

</form>
