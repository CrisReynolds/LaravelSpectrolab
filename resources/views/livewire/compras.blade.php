<div>
    <x-menu>

        <div class="flex justify-center items-center">
            <h2 class="text-4xl font-bold dark:text-black">Compras</h2>

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
            <div class="my-4">

                <form wire:submit.prevent="export" class="grid md:grid-cols-5 md:gap-6" autocomplete="off">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    wire:click="create">Registrar Compra</button>
                    <div class="mt-1">
                        <input type="date" wire:model="start_date" id="start_date"
                            class="dark:text-white block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        @error('start_date')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mt-1">
                        <input type="date" wire:model="end_date" id="end_date"
                            class="dark:text-white block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        @error('end_date')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="mt-0">
                        <button type="submit"
                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Exportar</button>
                    </div>

                </form>
            </div>
            @if ($isOpen)
                @include('compras.create-edit')
            @endif
        </section>

        @include('compras.index')
        <!-- resources/views/auth/login.blade.php -->
        {{-- Detalle de compra --}}

    </x-menu>
</div>
