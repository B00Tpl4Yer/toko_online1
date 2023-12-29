<x-app-layout>
    <div class="container pt-40 pb-20 max-w-full">
        <div class="w-full bg-gray-100 dark:bg-gray-800 border border-gray-100 dark:border-gray-800 rounded-xl p-5 flex justify-center text-center">

            <form action="{{ route('operator.bank.update', $pembayaran) }}" method="post" enctype="multipart/form-data" class="max-w-sm mx-auto">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <label for="nama_bank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan nama bank</label>
                    <input type="text" name="nama_bank" id="nama_bank" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan nama bank" value="{{ $pembayaran->nama_bank }}" required>
                </div>
                <div class="mb-5">
                    <label for="nama_rekening" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan nama rekening</label>
                    <input type="text" name="nama_rekening" id="nama_rekening" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan nama rekening" value="{{ $pembayaran->nama_rekening }}" required>
                </div>
                <div class="mb-5">
                    <label for="nomor_rekening" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan nomor rekening</label>
                    <input name="nomor_rekening" id="nomor_rekening" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan nomor rekening" value="{{ $pembayaran->nomor_rekening }}" required>

                </div>
                <div class="mb-5">
                    <label for="qrcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukkan QRcode</label>
                    <input type="file" name="qrcode" id="qrcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan foto QRcode" required>
                </div>

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>






        </div>

    </div>
</x-app-layout>

