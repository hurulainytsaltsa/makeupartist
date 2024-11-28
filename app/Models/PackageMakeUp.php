<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageMakeUp extends Model
{
    use HasFactory;
    protected $table = 'package_makeup';

    // Define the fillable properties
    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'photo',
    ];

    public function details()
    {
        return $this->hasMany(DetailsMakeUp::class, 'package_makeup_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'pkt_makeup');
    }
}
