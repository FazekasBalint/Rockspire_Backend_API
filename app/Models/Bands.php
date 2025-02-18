<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bands extends Model
{
    /** @use HasFactory<\Database\Factories\BandsFactory> */
    use HasFactory;

    protected $fillable =[
        'name',
        'image_url',
        'description',
        'day_id',
        'duration'
    ];
}
