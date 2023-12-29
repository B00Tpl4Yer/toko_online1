<x-app-layout>
    <div class="pt-40 pb-20">
        @if(session('error'))
        <script>
            const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "error",
  title: "{{ session('error') }}"
});
        </script>
        @endif

        <ol class="items-center flex mb-4 border-b border-gray-200 dark:border-gray-700 p-5" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">

            <li class="relative mb-6 sm:mb-0 w-full" role="presentation">
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <button>
                            <x-tabler-report-money class="w-5 h-5 text-blue-800 dark:text-blue-300" />
                        </button>
                    </div>
                    <div class=" w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <h3 class="text-sm xl:text-lg font-semibold text-gray-900 dark:text-white">Belum bayar</h3>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $belumbayar }}</time>
                    <button id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" class="border-b-2 text-xs xl:text-base font-normal text-gray-500 dark:text-gray-400">Lihat pesanan yg belum dibayar</button>
                </div>
            </li>
            <li class="relative mb-6 sm:mb-0 w-full" role="presentation">
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <button>
                            <x-tabler-car class="w-5 h-5 text-blue-800 dark:text-blue-300" />
                        </button>
                    </div>
                    <div class=" w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <h3 class="text-sm xl:text-lg font-semibold text-gray-900 dark:text-white">Barang dikirim</h3>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $barangdikirim  }}</time>
                    <button id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false" class="border-b-2 text-xs xl:text-base font-normal text-gray-500 dark:text-gray-400">Lihat pesanan yg sedang dikirim</button>
                </div>
            </li>
            <li class="relative mb-6 sm:mb-0 me-2 w-full" role="presentation">
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <button>
                            <x-tabler-discount-check class="w-5 h-5 text-blue-800 dark:text-blue-300" />
                        </button>
                    </div>
                    <div class=" w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <h3 class="text-sm xl:text-lg font-semibold text-gray-900 dark:text-white">barang diterima</h3>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $barangditerima }}</time>
                    <button id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false" class="text-xs xl:text-base font-normal border-b-2 text-gray-500 dark:text-gray-400">Lihat riwayat pesanan yg selesai</button>
                </div>
            </li>
        </ol>

        <div id="default-tab-content">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>

                                <th scope="col" class="px-6 py-3">
                                    Status pembayaran
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($show->where('status', 'belum bayar')->count() > 0)
                            @foreach ($show->where('status', 'belum bayar') as $order)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $order->status }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        {{ $order->orderItems->sum('quantity') }}
                                    </div>
                                </td>


                                <td class="px-6 py-4">
                                    <a href="{{ route('payment.form', ['order' => $order]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lakukan pembayaran</a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada pesanan </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>

                                <th scope="col" class="px-6 py-3">
                                    Status pengiriman
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($show->whereIn('status', ['menunggu pengiriman', 'barang dikirim'])->count() > 0)
                            @foreach ($show->whereIn('status', ['menunggu pengiriman', 'barang dikirim']) as $order)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $order->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            {{ $order->orderItems->sum('quantity') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($order->status =='menunggu pengiriman')
                                        <a href="{{ route('Send.form', ['order' => $order]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Pilih metode pengiriman</a>
                                        @else
                                        @if ($order->pengiriman && $order->pengiriman->metode_pengiriman)
                                        <a href="{{ route('user.see_send', $order) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                          Lihat metode pengiriman yg dipilih
                                        </a>
                                      @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada pesanan dengan status "menunggu pengiriman" atau "barang dikirim"</td>
                            </tr>
                        @endif


                        </tbody>
                    </table>
                </div>

            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>

                                <th scope="col" class="px-6 py-3">
                                    Status pesanan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($show->where('status', 'barang diterima')->count() > 0)
                            @foreach ($show->where('status', 'barang diterima') as $order)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $order->status }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        {{ $order->orderItems->sum('quantity') }}
                                    </div>
                                </td>


                                <td class="px-6 py-4">
                                    {{-- <a href="{{ route('payment.form', ['order' => $order]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lakukan pembayaran</a> --}}
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada pesanan </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
