<?php

namespace App\Livewire;

use Livewire\Component;
use app\Models\stok;

class Promote extends Component
{
    public function render()
    {
        // Fetch the latest products
        $latestProducts = Stok::latest()->take(4)->get();

        // Return the Livewire view with the latest products
        return view('livewire.promote', compact('latestProducts'));
    }
}
