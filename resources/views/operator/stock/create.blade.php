<x-app-layout>
    <div class="container pt-40 pb-20 max-w-full">
        <div class="w-full bg-gray-100 dark:bg-gray-800 border border-gray-100 dark:border-gray-800 rounded-xl p-5 flex justify-center text-center">

            <form action="{{ route('stock.store') }}" method="post" enctype="multipart/form-data" class="max-w-sm mx-auto">
                @csrf
                <div class="mb-5">
                    <label for="nama_produk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan nama produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan nama produk" required>
                </div>
                <div class="mb-5">
                    <label for="harga_produk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan harga produk</label>
                    <input type="number" name="harga_produk" id="harga_produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan harga produk" required>
                </div>
                <div class="mb-5">
                    <label for="informasi_produk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan informasi produk</label>
                    <textarea name="informasi_produk" id="informasi_produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan informasi produk" required>
                    </textarea>
                </div>
                <div class="mb-5">
                    <label for="deskripsi_produk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan deskripsi produk</label>
                    <textarea name="deskripsi_produk" id="deskripsi_produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan deskripsi produk" required>
                    </textarea>
                </div>
                <div class="mb-5">
                    <label for="jumlah_produk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan jumlah produk</label>
                    <input type="text" name="jumlah_produk" id="jumlah_produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan jumlah produk" required>
                </div>
                <div class="mb-5">
                    <label for="foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan foto produk</label>
                    <input type="file" name="foto" id="foto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan foto produk" required>
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>






        </div>

    </div>
</x-app-layout>
