<?php

namespace App\Livewire;
use App\Models\Stok;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Product extends Component
{
    use LivewireAlert;
    public $stok;
    public function render()
    {
        return view('livewire.product');
    }


    public function mount(Stok $stok)
    {
        $this->stok = $stok;
    }

    public function addToCart()
    {
        $productId = $this->stok->id;
        if ($this->stok->jumlah_produk <= 0) {
            $this->flash('error', 'Stok produk habis.');
            return;
        }
        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('stok_id', $productId)
            ->first();
        if ($existingCartItem) {
            $existingCartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'stok_id' => $productId,
                'quantity' => 1,
            ]);
        }

        $this->stok->decrement('jumlah_produk');

        // session()->flash('success', 'Produk ditambahkan keranjang');
        // $this->js("alert('success', 'produk telah ditambahkan ke keranjang!')");
        $this->alert('success', 'produk telah ditambahkan ke keranjang!');


    }

}
