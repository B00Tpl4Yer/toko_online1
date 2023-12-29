<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'slug',
    ];

    protected $enums = [
        'status' => [
            'belum bayar',
            'menunggu pengiriman',
            'barang dikirim',
            'barang diterima',
        ]
    ];
    public function getRouteKeyName()
{
    return 'slug';
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stok::class, 'stok_id','id');
    }
    public function orderItems()
    {
        return $this->hasMany(order_item::class);
    }

    public function cart()
    {
        return $this->belongsTo(cart::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
    public function pengiriman()
    {
        return $this->hasOne(pengiriman::class);
    }
    public function metodepengiriman()
    {
        return $this->belongsTo(metodepengiriman::class);
    }
}
