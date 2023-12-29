<x-Public-layout>
    @section('content')
    <div class="container">

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 ">
            <div class="">
                <img class="rounded-t-lg w-full" src="{{ Storage::url($stok->foto) }}" alt="{{ $stok->nama_produk }}" onerror="this.src='{{ asset($stok->foto) }}'; this.alt='Foto Default';" />
            </div>
            <div class="text-left text-gray-700 dark:text-gray-100 mb-10">
                <h1 class="font-bold text-3xl mb-10">{{ $stok->nama_produk }}</h1>
                <h1 class="font-bold text-5xl mb-20">Rp {{ number_format($stok->harga_produk, 0, ',', '.') }}.000</h1>
                @livewire('product', ['stok' => $stok])
                <p class="font-normal text-md mb-5 mt-5">Informasi produk:{{ $stok->informasi_produk }}</p>
                <p class="font-normal text-md mb-5">Deskripsi produk:{{ $stok->deskripsi_produk }}</p>
            </div>
        </div>
        <br><br><br><br>
    </div>
@endsection
</x-Public-layout>
