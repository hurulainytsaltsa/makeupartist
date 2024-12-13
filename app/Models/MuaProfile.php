<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuaProfile extends Model
{
    use HasFactory;

    protected $table = 'mua_profiles';

    // Define the fillable properties
    protected $fillable = ['nama_mua', 'pengalaman', 'lokasi', 'portfolio_link', 'profile_photo'];

    public function penugasans()
    {
        return $this->hasMany(Penugasans::class, 'nama_mua', 'nama_mua');
    }
}
