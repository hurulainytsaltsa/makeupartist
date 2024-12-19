<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    use HasFactory;

    protected $table = 'honors';
    protected $fillable = [
        'penugasan_id',
        'mua_id',
        'gaji_kotor',
        'gaji_bersih',
        'status',
        'bukti_pembayaran',
    ];

    // Relasi ke tabel penugasans
    public function penugasan()
    {
        return $this->belongsTo(Penugasans::class, 'penugasan_id', 'id');
    }

    // Relasi ke tabel mua_profiles
    public function muaProfile()
    {
        return $this->belongsTo(MuaProfile::class, 'mua_id', 'id');
    }
}
