<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodepengiriman extends Model
{

    use HasFactory;

    protected $fillable = [
        'nama_kurir',
        'nomor_telepon',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'metode_pengiriman_user')
            ->withTimestamps();
    }
}
