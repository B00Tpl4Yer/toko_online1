<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
class stok extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'harga_produk',
        'informasi_produk',
        'deskripsi_produk',
        'foto',
        'jumlah_produk',
        'slug',
    ];
    public function getRouteKeyName()
{
    return 'slug';
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stok()
    {
        return $this->belongsTo(stok::class);
    }
}
