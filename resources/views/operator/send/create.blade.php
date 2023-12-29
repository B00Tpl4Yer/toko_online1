
<x-app-layout>
    <div class="container pt-40 pb-20 max-w-full">
        <div class="w-full bg-gray-100 dark:bg-gray-800 border border-gray-100 dark:border-gray-800 rounded-xl p-5 flex justify-center text-center">

            <form action="{{ route('operator.send.store') }}" method="post" enctype="multipart/form-data" class="max-w-sm mx-auto">
                @csrf
                <div class="mb-5">
                    <label for="nama_kurir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan nama kurir</label>
                    <input type="text" name="nama_kurir" id="nama_kurir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan nama kurir" required>
                </div>
                <div class="mb-5">
                    <label for="nomor_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan nomor telepon</label>
                    <input type="number" name="nomor_telepon" id="nomor_telepon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan nomor telepon" required>
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>

        </div>

    </div>
</x-app-layout>


