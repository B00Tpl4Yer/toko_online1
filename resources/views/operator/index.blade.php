<x-app-layout>

    <div class="container">
        <form action="{{ route('operator.index') }}" method="GET" class="mt-3">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <div class="flex flex-row gap-4">
                    <input type="search" id="default-search" name="search" value="{{ $search }}" class="w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-100 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="cari....." required>
                    <button type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cari</button>
                </div>
            </div>
        </form>

        {{-- <a href="{{ route('operatorshoworders') }}">view orders</a> --}}
        @if($latestProducts->count() > 0)
            <h3>Latest Products</h3>
            <div class="row">
                @foreach($latestProducts as $product)
                    <div class="col-md-3">
                        <div class="card mb-4">
                            @if($product->foto)
                                <img src="{{ asset('uploads/' . $product->foto) }}" alt="{{ $product->nama_produk }}" class="card-img-top">
                            @else
                                <img src="{{ asset('placeholder.jpg') }}" alt="Product Placeholder" class="card-img-top">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->nama_produk }}</h5>
                                <p class="card-text">${{ $product->harga_produk }}</p>
                                {{-- <a href="{{ route('operator.stock.show', $product) }}" class="btn btn-info">View</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <h2>Product List</h2>
        <a href="{{ route('stock.create') }}" class="btn btn-primary mb-3">Add Product</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif

        <table class="table">
            <thead>
                <tr>

                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stoks as $stock)
                    <tr>

                        <td>{{ $stock->nama_produk }}</td>
                        <td>{{ $stock->harga_produk }}</td>
                        <td>{{ $stock->jumlah_produk }}</td>
                        <td>
                            <a href="{{ route('stock.edit',$stock) }}">edit</a>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No products available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-app-layout>
