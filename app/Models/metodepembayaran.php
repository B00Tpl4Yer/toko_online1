<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodepembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bank',
        'nama_rekening',
        'nomor_rekening',
        'qrcode',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
