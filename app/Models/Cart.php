<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stok_id',
        'quantity',
    ];

    public function stock()
    {
        return $this->belongsTo(Stok::class, 'stok_id','id');
    }
}
