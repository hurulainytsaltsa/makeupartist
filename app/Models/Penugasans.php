<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasans extends Model
{
    use HasFactory;

    protected $table = 'penugasans';

    protected $fillable = ['booking_id', 'nama', 'no_telp', 'alamat', 'tgl_makeup','jam', 'pkt_makeup', 'jenis_paket', 'nama_mua'];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function packagesMakeUp()
    {
        return $this->belongsTo(PackageMakeUp::class, 'pkt_makeup', 'id'); // Sesuaikan 'id' dengan primary key di tabel PackageMakeUp
    }

    public function detailsMakeUp()
    {
        return $this->belongsTo(DetailsMakeUp::class, 'jenis_paket', 'id'); // Sesuaikan 'id' dengan primary key di tabel DetailsMakeUp
    }

    // Relasi ke tabel mua_profiles
    public function muaProfile()
    {
        return $this->belongsTo(MuaProfile::class, 'nama_mua', 'nama_mua');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    // public function booking1()
    // {
    //     return $this->belongsTo(Booking::class, 'nama');
    // }
}
