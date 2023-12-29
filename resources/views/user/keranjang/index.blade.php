<x-app-layout>
    <br><br><br><br>

    @livewire('keranjang')

    <form action="{{ route('checkout') }}" method="post">
        @csrf

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <div class="pt-5 flex flex-col justify-center items-center bg-white border dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 ">
                <div class=" animate-bounce">
                    <x-tabler-arrow-narrow-down class="w-10 h-10 text-center text-blue-600 dark:text-blue-500 hover:underline" />
                </div>
                <button type="submit" class="">
                    <x-tabler-shopping-cart class="w-28 h-28 text-center text-blue-600 dark:text-blue-500 hover:underline" />
                </button>
            </div>
        </div>
    </form>

    <br><br><br><br>
</x-app-layout>
