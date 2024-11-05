<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    /** @use HasFactory<\Database\Factories\PortofolioFactory> */
    use HasFactory;
    protected $table = 'portofolio';

    // Define the fillable properties
    protected $fillable = [
        'nama_mua',
        'review',
        'gambar',
    ];
}
