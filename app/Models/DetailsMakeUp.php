<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsMakeUp extends Model
{
    use HasFactory;

    protected $table = 'detail_packages';

    protected $fillable = [
        'name',
        'type',
        'description',
        'price',
        'bonus',
        'package_makeup_id',
    ];

    public function package()
    {
        return $this->belongsTo(PackageMakeUp::class, 'package_makeup_id');
    }

}
