<x-app-layout>

    <div class="container pt-20 pb-20">
        {{-- Tambahkan informasi order atau pesan sukses jika diperlukan --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->stock->nama_produk ?? 'Product Not Found' }}</td>
                        <td>{{ $cartItem->quantity }}</td>
                        <td>{{ $cartItem->stock->harga_produk }}</td>

                    </tr>
                @endforeach
                <h1>Choose Send Method</h1>
                <form action="{{ route('user.process_send', $order) }}" method="post">
                    @csrf
                    <label for="payment_method">Choose Payment Method:</label>
                    <select name="payment_method" id="payment_method">
                        <option value="COD">ambil di toko</option>
                        <option value="pengiriman">Pengiriman</option>
                    </select>
                    <button type="submit">Proceed to Payment</button>
                </form>


            </tbody>
        </table> --}}

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
                            {{-- <th scope="col" class="px-6 py-3">
                                Action
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $cartItem)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="p-4">
                                <img src="{{ asset('uploads/'. $cartItem->stock->foto) }}" class="w-16 md:w-32 max-w-full max-h-full rounded-xl" alt="{{ $cartItem->stock->nama_produk }}" onerror="this.src='{{ asset($cartItem->stock->foto) }}'; this.alt='Foto Default';">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $cartItem->stock->nama_produk }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">


                                    <p class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $cartItem->quantity }}</p>


                                </div>
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                               Rp. {{ number_format($cartItem->stock->harga_produk, 0, ',', '.') }}.000
                            </td>
                            {{-- <td class="px-6 py-4">
                                <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                            </td> --}}
                        </tr>
                        @endforeach
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td colspan="5" class="px-6 py-4 font-bold text-gray-900 dark:text-white text-5xl text-center">
                                Rp. {{ number_format($totalHargaProduk, 0, ',', '.') }}.000
                             </td>
                        </tr>



                    </tbody>
                </table>
            </div>

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
                        @foreach($orderItems as $cartItem)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="p-4">
                                <img src="{{ asset('uploads/'. $cartItem->stock->foto) }}" class="w-16 md:w-32 max-w-full max-h-full rounded-xl" alt="{{ $cartItem->stock->nama_produk }}" onerror="this.src='{{ asset($cartItem->stock->foto) }}'; this.alt='Foto Default';">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white flex flex-col">
                                <div class="mb-2">{{ $cartItem->stock->nama_produk }}</div>
                                <p class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    Rp. {{ number_format($cartItem->stock->harga_produk, 0, ',', '.') }}.000
                                 </p>
                                <div class="flex items-center">

                                    </form>
                                    <div>
                                        <p class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $cartItem->quantity }}</p>
                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-4">
                                <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td colspan="2" class="px-6 py-4 font-bold text-gray-900 dark:text-white text-2xl xl:text-5xl text-center">
                                Rp. {{ number_format($totalHargaProduk, 0, ',', '.') }}.000
                             </td>

                        </tr>
                    </tbody>
                </table>
            </div>



        </div>
        <form action="{{ route('user.process_send', $order) }}" method="post">
            @csrf

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                <div class="pt-5 flex flex-col justify-center items-center bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 ">
                    <div class=" animate-bounce">
                        <x-tabler-arrow-narrow-down class="w-10 h-10 text-center text-blue-600 dark:text-blue-500 hover:underline" />
                    </div>

                    <div>

                        <select id="payment_method" name="payment_method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                          <option selected>pilih metode pengiriman</option>
                          <option value="COD">ambil ditempat</option>
                          <option value="pengiriman">pengiriman</option>
                        </select>

                    </div>
                    <button type="submit" class="">
                        <x-tabler-shopping-cart class="w-28 h-28 text-center text-blue-600 dark:text-blue-500 hover:underline" />
                    </button>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>
