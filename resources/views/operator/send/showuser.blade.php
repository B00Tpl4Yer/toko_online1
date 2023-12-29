<x-app-layout>
    @section('content')
    <div class="container">
        @foreach ($users as $loopUser)
        <form action="{{ route('operator.send.user', $loopUser) }}" method="post">
            @csrf
            @method('PUT')

            <label for="metodePengiriman">Pilih Metode Pengiriman untuk Pengguna {{ $loopUser->name }}:</label>
            <select name="metodePengiriman[]" multiple>
                @foreach($metodePengiriman as $metode)
                    <option value="{{ $metode->id }}" {{ $loopUser->metodePengiriman->contains($metode->id) ? 'selected' : '' }}>
                        {{ $metode->nama_metode }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Simpan</button>
        </form>
        @endforeach
    </div>
    @endsection
</x-app-layout>
