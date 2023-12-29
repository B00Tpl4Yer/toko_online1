<div>

    @if(auth()->check())
    @if(Auth::user()->hasRole('operator'))
    <a href="{{ route('stock.edit',$stok) }}" class="flex flex-row w-52 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><x-tabler-shopping-cart-plus />edit produk</a>
    @else
        <form wire:submit.prevent="addToCart">
            <button type="submit" class="flex flex-row w-52 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><x-tabler-shopping-cart-plus />Tambah ke keranjang</button>
        </form>
    @endif

    @else
    <a href="{{ route('login') }}" class="flex flex-row w-52 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><x-tabler-shopping-cart-plus />Tambah ke keranjang</a>

    @endif

        <p><strong>Stok:</strong> {{ $stok->jumlah_produk }}</p>
    </div>
