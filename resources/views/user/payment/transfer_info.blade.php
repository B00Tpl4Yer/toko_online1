<x-app-layout>
    <div class="container pt-20 pb-20">
        <h1 class="text-center text-lg xl:text-2xl text-black dark:text-white font-semibold mb-5">silahkan lakukan pembayaran di rekening berikut ini <br> dan upload bukti pembayarannya</h1>
        <div class="flex  justify-center ">
            @foreach($rekening as $rekeningItem)

            <div class="max-w-xl w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
                </a>
                <div class="p-20">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">nama bank:{{ $rekeningItem->nama_bank }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">nama rekening:{{ $rekeningItem->nama_rekening }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">nomor rekening:{{ $rekeningItem->nomor_rekening }}</p>

                </div>
            </div>



            @endforeach
        </div>
        <div class="flex justify-center">
            <a href="{{ route('user.order.upload_proof_form', $order) }}"  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Upload bukti pembayaran</a>
        </div>

    </div>
</x-app-layout>
