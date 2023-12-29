<x-Public-layout>

    @section('content')
    <div class="container max-w-full">
        @livewire('promote')

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

        @livewire('search')
        <br><br><br><br>
    </div>
    @endsection
</x-Public-layout>
