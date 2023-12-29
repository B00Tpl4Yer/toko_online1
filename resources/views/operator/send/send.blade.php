<x-app-layout>
    <div class="container">
        <h1>Assign Shipping Method</h1>

        <form action="{{ route('operator.assignShippingMethod', $user) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="metodepengiriman">Pilih Metode Pengiriman</label>
                <select name="metodepengiriman" class="form-control" required>
                    @foreach($availableMethods as $method)
                        <option value="{{ $method->id }}">{{ $method->nama_kurir }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Assign Shipping Method</button>
        </form>
    </div>
</x-app-layout>
