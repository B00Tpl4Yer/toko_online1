<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengiriman extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'metode_pengiriman',
        'status',
    ];
    protected $enums = [
        'status' => [
            'menunggu',
            'telah dikirim',
        ]
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}

