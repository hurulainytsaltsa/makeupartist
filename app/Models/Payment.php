<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';

    protected $fillable = [
        'no_rekening',
        'bukti_pembayaran',
        'status_pembayaran',
        'booking_id',
    ];

    // public function booking()
    // {
    //     return $this->hasMany(Booking::class, 'booking_id');
    // }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
