<?php

namespace App\Livewire;

use App\Models\Stok;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Item;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Keranjang extends Component
{
    public $stok;
    public $cartItems;
    public $totalPrice = 0;

    public function mount(Stok $stok)
    {
        $this->stok = $stok;
        $this->cartItems = Cart::where('user_id', auth()->id())->get();
        $this->calculateTotalPrice();
    }
    private function calculateTotalPrice()
    {
        $this->totalPrice = $this->cartItems->sum(function ($cartItem) {
            // Calculate the total price for each item (quantity * price)
            return $cartItem->quantity * $cartItem->stock->harga_produk;
        });
    }

    public function render()
    {
        return view('livewire.keranjang');
    }

    public function addToCart($stokId)
    {
        // Cek apakah stok produk masih tersedia
        $stok = Stok::find($stokId);
        if (!$stok || $stok->jumlah_produk <= 0) {
            session()->flash('error', 'Stok produk habis atau tidak ditemukan.');
            return;
        }

        // Cek apakah stok produk sudah ada di keranjang
        $existingCartItem = Cart::where('user_id', auth()->id())
            ->where('stok_id', $stokId)
            ->first();

        if ($existingCartItem) {
            // Jika sudah ada, tambahkan jumlah produk di keranjang
            $existingCartItem->increment('quantity');
        } else {
            // Jika belum ada, tambahkan produk baru ke keranjang
            Cart::create([
                'user_id' => auth()->id(),
                'stok_id' => $stokId,
                'quantity' => 1,
            ]);
        }

        // Kurangkan stok produk sebanyak 1
        $stok->decrement('jumlah_produk');
        $this->cartItems = Cart::where('user_id', auth()->id())->get();
        $this->calculateTotalPrice();

        session()->flash('success', 'Produk ditambahkan ke keranjang');
    }

    public function reduceQuantity($cartItemId)
    {
        // Validasi apakah user yang sedang login adalah pemilik keranjang
        $cartItem = Cart::findOrFail($cartItemId);
        if ($cartItem->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Kurangi jumlah produk di keranjang
        $cartItem->decrement('quantity');
        $cartItem->stock->increment('jumlah_produk');

        // Jika jumlah produk di keranjang hanya 0, hapus produk dari keranjang
        if ($cartItem->quantity == 0) {
            $cartItem->delete();
        }
        $this->cartItems = Cart::where('user_id', auth()->id())->get();
        $this->calculateTotalPrice();

        // Redirect atau tampilkan view keranjang belanja
        session()->flash('success', 'Produk dikurangi dari keranjang');
    }

    // public function checkout()
    // {
    //     // Mendapatkan produk yang ada di keranjang pengguna
    //     $cartItems = Cart::with('stock')->where('user_id', auth()->id())->get();

    //     // Grupkan produk berdasarkan stok_id untuk menggabungkan barang dengan id yang sama
    //     $groupedCartItems = $cartItems->groupBy('stok_id');

    //     // Buat order baru
    //     $randomSlug = Str::slug(Str::random(8));
    //     while (Order::where('slug', $randomSlug)->exists()) {
    //         $randomSlug = Str::slug(Str::random(8));
    //     }

    //     $order = Order::create([
    //         'user_id' => auth()->id(),
    //         'status' => 'belum bayar',
    //         'slug' => $randomSlug,
    //     ]);

    //     foreach ($groupedCartItems as $stokId => $group) {
    //         $totalQuantity = 0;

    //         foreach ($group as $cartItem) {
    //             // Mendapatkan jumlah yang dipilih untuk setiap produk di keranjang
    //             $selectedQuantity = $cartItem->quantity;

    //             // Validasi bahwa jumlah yang dipilih tidak melebihi jumlah barang di keranjang
    //             if ($selectedQuantity > $cartItem->stock->jumlah_produk) {
    //                 session()->flash('error', 'Jumlah yang dipilih melebihi jumlah barang di keranjang');
    //                 return redirect()->back();
    //             }

    //             // Tambahkan jumlah produk
    //             $totalQuantity += $selectedQuantity;

    //             // Kurangkan stok produk di keranjang
    //             $cartItem->stock->decrement('jumlah_produk', $selectedQuantity);

    //             // Hapus barang dari keranjang
    //             $cartItem->delete();

    //             // Tambahkan produk ke dalam order_item
    //             Order_Item::create([
    //                 'order_id' => $order->id,
    //                 'stok_id' => $stokId,
    //                 'quantity' => $selectedQuantity,
    //             ]);
    //         }
    //     }

    //     session()->flash('success', 'Barang berhasil dipindahkan ke pesanan');
    //     return redirect()->route('showorders');
    // }
}
