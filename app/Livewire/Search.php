<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\stok;
use Livewire\WithPagination;
class Search extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.search', [
            'searchResults' => Stok::where('nama_produk', 'like', '%' . $this->search . '%')->paginate(20)
        ]);
    }


}

