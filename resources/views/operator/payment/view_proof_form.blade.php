@extends('layouts.app')

@section('content')
    <h1>Upload Payment Proof</h1>

    <form action="{{ route('user.order.upload_proof', $order) }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="bukti_pembayaran">Upload Payment Proof:</label>
        <input type="file" name="bukti_pembayaran" accept="image/*">
        <button type="submit">Submit</button>
    </form>
@endsection
