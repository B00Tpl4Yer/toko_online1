<x-app-layout>



        <div class="container pt-40">
            <div class="text-center flex justify-center">
                @if (!is_null($order->pembayaran->bukti_pembayaran))
                <img src="{{ asset('payment_proofs/' . $order->pembayaran->bukti_pembayaran) }}" alt="Payment Proof" class="w-96 rounded-xl border">
                @else
                <p></p>
                @endif
            </div>
            <div class="flex justify-center">
                <form action="{{ route('operator.verifysend', $order) }}" method="post">
                    @csrf
                    <label for="verification_status"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">verifikasi pengiriman:</label>
                    <select name="verification_status" id="verification_status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>pilih jawaban</option>
                        <option value="telah dikirim">verifikasi</option>
                    </select>
                    <button type="submit"
                        class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">submit</button>

                </form>
            </div>
        </div>

</x-app-layout>
