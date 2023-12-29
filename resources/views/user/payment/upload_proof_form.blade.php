{{-- <x-app-layout>
<div class="container pt-40">
    <h1>Upload Payment Proof</h1>

    <form action="{{ route('user.order.upload_proof', $order) }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="bukti_pembayaran">Upload Payment Proof:</label>
        <input type="file" name="bukti_pembayaran" accept="image/*">
        <button type="submit">Submit</button>
    </form>
</div>
</x-app-layout> --}}
<x-app-layout>
    <div class="container pt-40">

    <div class="flex flex-col">
        <form action="{{ route('user.order.upload_proof', $order) }}" method="post" enctype="multipart/form-data" class="border rounded-xl ">
            @csrf
            <label for="bukti_pembayaran" class="flex justify-center text-black dark:text-white text-xl mb-5 ">Upload Payment Proof:</label>
            <div class="flex justify-center">
                <input type="file" name="bukti_pembayaran" accept="image/*" class="rounded-xl text-black dark:text-white">
                <button type="submit" class="text-white bg-blue-500 border px-5 rounded-xl">Submit</button>
            </div>
        </form>
    </div>
    </div>
    </x-app-layout>

