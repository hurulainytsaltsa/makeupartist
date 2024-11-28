<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    /** @use HasFactory<\Database\Factories\CalendarFactory> */
    use HasFactory;
    protected $table = 'calendars';

    // Define the fillable properties
    protected $fillable = [
        'title',
        'start',
        'color'
    ];

}
