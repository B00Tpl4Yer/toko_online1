<div>
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative mb-5">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <div class="flex flex-row gap-4">
            <input wire:model.live="search" type="text" class="w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-100 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="search">
        </div>
    </div>

    @if($searchResults->count() > 0)

    <div class="grid grid-cols-2 xl:grid-cols-6 md:grid-cols-4 gap-5">
        @foreach($searchResults as $stok)

        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 transition duration-300 ease-in-out hover:transform hover:scale-105">
            <a href="{{ route('stock.show',$stok) }}">
                <img class="rounded-t-lg" src="{{ Storage::url($stok->foto) }}" onerror="this.src='{{ asset($stok->foto) }}'; this.alt='Foto Default';" />
            </a>
            <div class="p-5">
                <h5 class="mb-2 text-md xl:text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $stok->nama_produk }}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Rp {{ number_format($stok->harga_produk, 0, ',', '.') }}.000</p>
                <a href="{{ route('stock.show',$stok) }}" class="flex flex-row text-gray-700 dark:text-gray-400"><x-tabler-eye />Lihat produk</a>
                <form action="{{ route('stok.destroy', ['stok' => $stok]) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Are you sure you want to delete this stok?')">Hapus</button>
                </form>



            </div>
        </div>

        @endforeach
    </div>
    <div class="grid grid-cols-1">
        {{ $searchResults->links() }}
    </div>
    @else
    <p>No results found.</p>
    @endif
</div>
