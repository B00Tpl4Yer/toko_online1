<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status',
    ];
    protected $enums = [
        'status' => [
            'menunggu',
            'diverifikasi',
            'ditolak',
        ]
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
