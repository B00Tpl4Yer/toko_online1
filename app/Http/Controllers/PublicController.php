<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stok;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil 4 produk terbaru
        $latestProducts = stok::latest()->take(4)->get();

        return view('welcome', compact('latestProducts'));
    }

    public function show(stok $stok)
    {
        return view('showstok', compact('stok'));
    }


}
