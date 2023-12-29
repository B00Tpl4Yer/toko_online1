<x-app-layout>

    <div class="container">
        <h2>Edit Product</h2>
        <form action="{{ route('stock.update', $stok) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_produk">Product Name</label>
                <input type="text" name="nama_produk" class="form-control" value="{{ $stok->nama_produk }}" required>
            </div>
            <div class="form-group">
                <label for="harga_produk">Product Price</label>
                <input type="number" name="harga_produk" class="form-control" value="{{ $stok->harga_produk }}" required>
            </div>
            <div class="form-group">
                <label for="informasi_produk">Product Information</label>
                <textarea name="informasi_produk" class="form-control" required>{{ $stok->informasi_produk }}</textarea>
            </div>
            <div class="form-group">
                <label for="deskripsi_produk">Product Description</label>
                <textarea name="deskripsi_produk" class="form-control" required>{{ $stok->deskripsi_produk }}</textarea>
            </div>
            <div class="form-group">
                <label for="foto">Product Photo</label>
                <input type="file" name="foto" class="form-control-file"  value="{{ $stok->foto }}">
            </div>
            <div class="form-group">
                <label for="jumlah_produk">Product Quantity</label>
                <input type="number" name="jumlah_produk" class="form-control" value="{{ $stok->jumlah_produk }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>

</x-app-layout>
