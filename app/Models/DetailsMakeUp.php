<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsMakeUp extends Model
{
    use HasFactory;

    protected $table = 'detail_packages';

    protected $fillable = [
        'name',          // e.g., Paket A, Paket B
        'type',          // package, addon, or service
        'description',   // Additional details, if any
        'price',         // Price of the package or add-on
        'bonus',         // Bonus description, if applicable
        'package_makeup_id', // Foreign key linking to package_makeup
    ];

    public function package()
    {
        return $this->belongsTo(PackageMakeUp::class, 'package_makeup_id');
    }

}
