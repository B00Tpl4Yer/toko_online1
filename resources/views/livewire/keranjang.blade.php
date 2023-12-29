<div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg hidden md:block">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-16 py-3">
                        <span class="sr-only">Image</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Product
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $cartItem)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <img src="{{ asset('uploads/'. $cartItem->stock->foto) }}" class="w-16 md:w-32 max-w-full max-h-full rounded-xl" alt="{{ $stok->nama_produk }}" onerror="this.src='{{ asset($cartItem->stock->foto) }}'; this.alt='Foto Default';">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{ $cartItem->stock->nama_produk }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <form wire:submit.prevent="reduceQuantity({{ $cartItem->id }})">
                                <button type="submit" class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                                    <span class="sr-only">Quantity button</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                    </svg>
                                </button>
                            </form>

                            <p class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $cartItem->quantity }}</p>

                            <form wire:submit.prevent="addToCart({{ $cartItem->stok_id }})">
                                <button  type="submit" class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                                    <span class="sr-only">Quantity button</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                       Rp. {{ number_format($cartItem->stock->harga_produk, 0, ',', '.') }}.000
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                    </td>
                </tr>
                @endforeach
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td colspan="5" class="px-6 py-4 font-bold text-gray-900 dark:text-white text-5xl text-center">
                        Rp. {{ number_format($totalPrice, 0, ',', '.') }}.000
                     </td>
                </tr>



            </tbody>
        </table>
    </div>
{{-- responsive --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg md:hidden">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-16 py-3">
                        <span class="sr-only">Image</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Product
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $cartItem)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <img src="{{ asset('uploads/'. $cartItem->stock->foto) }}" class="w-16 md:w-32 max-w-full max-h-full rounded-xl" alt="{{ $stok->nama_produk }}" onerror="this.src='{{ asset($cartItem->stock->foto) }}'; this.alt='Foto Default';">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white flex flex-col">
                        <div class="mb-2">{{ $cartItem->stock->nama_produk }}</div>
                        <p class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            Rp. {{ number_format($cartItem->stock->harga_produk, 0, ',', '.') }}.000
                         </p>
                        <div class="flex items-center">
                            <form wire:submit.prevent="reduceQuantity({{ $cartItem->id }})">
                            <button type="submit" class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                                <span class="sr-only">Quantity button</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                </svg>
                            </button>
                            </form>
                            <div>
                                <p class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $cartItem->quantity }}</p>
                            </div>
                            <form wire:submit.prevent="addToCart({{ $cartItem->stok_id }})">
                            <button  type="submit" class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                                <span class="sr-only">Quantity button</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                </svg>
                            </button>
                            </form>
                        </div>

                    </td>

{{--
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                    </td> --}}
                </tr>
                @endforeach
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td colspan="2" class="px-6 py-4 font-bold text-gray-900 dark:text-white text-2xl xl:text-5xl text-center">
                        Rp. {{ number_format($totalPrice, 0, ',', '.') }}.000
                     </td>

                </tr>
            </tbody>
        </table>
    </div>



</div>
