<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'stok_id',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stok::class, 'stok_id','id');
    }
}
