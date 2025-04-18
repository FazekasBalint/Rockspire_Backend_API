<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    /** @use HasFactory<\Database\Factories\BandFactory> */
    use HasFactory;

    protected $fillable = ['name', 'image_url', 'logo_url', 'description', 'day_id','start_time','end_time'];

    public function days()
    {
        return $this->belongsTo(Day::class,'day_id');
    }
}
