<x-app-layout>
{{-- <div class="container">
    <h2>Assigned Shipping Methods:</h2>
        <p>{{ $rekening->nama_kurir }} -</p>
        <p>{{ $rekening->nomor_telepon }} -</p>
</div> --}}

<div class="container pt-40">
    <div class="border w-full rounded-xl ">
        <div class="text-black dark:text-white text-center text-xl ">silahkan hubungi kurir di bawah ini untuk proses pengiriman anda</div>
        <div class="text-center text-black dark:text-white">
            <p>{{ $rekening->nama_kurir }}</p>
            <a href="https://wa.me/{{ $rekening->nomor_telepon }}">{{ $rekening->nomor_telepon }}</a>
        </div>
    </div>

</div>


</x-app-layout>
