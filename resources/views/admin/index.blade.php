<x-app-layout>

<div class="container p-5 max-w-full">
    <div class="grid grid-cols-1 gap-8">
        @if(session('success'))
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
  icon: "success",
  title: "{{ session('success') }}"
});
        </script>
        @endif

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

        <form action="{{ route('admin.index') }}" method="GET" class="mt-3">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <div class="flex flex-row gap-4">
                    <input type="search" id="default-search" name="search" value="{{ $search }}" class="w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-100 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="cari....." required>
                    <button type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cari</button>
                </div>
            </div>
        </form>
    </div>
    <h1 class="mb-5 text-center text-lg font-semibold text-black dark:text-white">Daftar user </h1>
    <div class="grid grid-cols-1 gap-1 md:grid-cols-2 md:gap-2 xl:grid-cols-4 xl:gap-3">
        @foreach($user as $user)
        <div class="w-full max-w-sm  border bg-gray-100 dark:bg-gray-800 rounded-lg shadow dark:border-gray-700">
            <div class="flex flex-col items-center pb-5">
                <img class="mt-3 w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('asset/img/user.png') }}" alt="Anggota"  />
                <p class="text-sm text-black dark:text-white">{{ $user->name }}</p>
                <p class="text-sm text-black dark:text-white">{{ $user->email }}</p>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <form method="POST" action="{{ route('admin.naikkan-tingkat', $user) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">Naikkan Tingkat</button>
                </form>
                <form method="POST" action="{{ route('admin.turunkan-tingkat', $user) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">turunkan Tingkat</button>
                </form>
                <a href="{{ route('admin.delete-user', $user) }}"> <button> Hapus</button></a>
                <form method="POST" action="{{ route('admin.ganti-password', $user) }}">
                    @csrf

                    <div class="relative z-0 w-full mb-6 group text-left">
                        <input type="password" id="password" name="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-[#22C55E] focus:outline-none focus:ring-0 focus:border-[#22C55E] peer" placeholder=""  required>
                        <label for="password" class=" peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-[#22C55E] peer-focus:dark:text-[#22C55E] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    </div>
                    <div class="relative z-0 w-full mb-6 group text-left">
                        <input type="password_confirmation" id="password_confirmation" name="password_confirmation" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-[#22C55E] focus:outline-none focus:ring-0 focus:border-[#22C55E] peer" placeholder=""  required>
                        <label for="password" class=" peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-[#22C55E] peer-focus:dark:text-[#22C55E] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">konfirmasi Password</label>
                    </div>
                    <button type="submit" class=" relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-[#22C55E] to-blue-500 group-hover:from-green-500 group-hover:to-blue-700 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            Ubah password
                        </span>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <h1 class="mb-5 text-center text-lg font-semibold text-black dark:text-white mt-5">Daftar Operator </h1>
    <div class="grid grid-cols-1 gap-1 md:grid-cols-2 md:gap-2 xl:grid-cols-4 xl:gap-3">
        @foreach($operator as $user)
        <div class="w-full max-w-sm  border bg-gray-100 dark:bg-gray-800 rounded-lg shadow dark:border-gray-700">
            <div class="flex flex-col items-center pb-5">
                <img class="mt-3 w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('asset/img/user.png') }}" alt="Anggota"  />
                <p class="text-sm text-black dark:text-white">{{ $user->name }}</p>
                <p class="text-sm text-black dark:text-white">{{ $user->email }}</p>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <form method="POST" action="{{ route('admin.naikkan-tingkat', $user) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">Naikkan Tingkat</button>
                </form>
                <form method="POST" action="{{ route('admin.turunkan-tingkat', $user) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">turunkan Tingkat</button>
                </form>
                <a href="{{ route('admin.delete-operator', $user) }}"> <button>Hapus</button></a>
                                <form method="POST" action="{{ route('admin.ganti-password', $user) }}">
                    @csrf

                    <div class="relative z-0 w-full mb-6 group text-left">
                        <input type="password" id="password" name="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-[#22C55E] focus:outline-none focus:ring-0 focus:border-[#22C55E] peer" placeholder=""  required>
                        <label for="password" class=" peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-[#22C55E] peer-focus:dark:text-[#22C55E] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    </div>
                    <div class="relative z-0 w-full mb-6 group text-left">
                        <input type="password_confirmation" id="password_confirmation" name="password_confirmation" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-[#22C55E] focus:outline-none focus:ring-0 focus:border-[#22C55E] peer" placeholder=""  required>
                        <label for="password" class=" peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-[#22C55E] peer-focus:dark:text-[#22C55E] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">konfirmasi Password</label>
                    </div>
                    <button type="submit" class=" relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-[#22C55E] to-blue-500 group-hover:from-green-500 group-hover:to-blue-700 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            Ubah password
                        </span>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

</x-app-layout>

