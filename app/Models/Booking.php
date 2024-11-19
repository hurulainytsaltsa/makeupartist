<?php

namespace App\Models;

use App\Http\Controllers\UserProfileController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;
    protected $table = 'booking';

    // Define the fillable properties
    protected $fillable = [
        'nama',
        'email',
        'no_telp',
        'alamat',
        'tgl_makeup',
        'pkt_makeup',
        'jam',
        'jenis_paket'
    ];

    public function packagesMakeUp()
    {
        return $this->belongsTo(PackageMakeUp::class, 'pkt_makeup');
    }

    public function detailsMakeUp()
    {
        return $this->belongsTo(DetailsMakeUp::class, 'jenis_paket');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
