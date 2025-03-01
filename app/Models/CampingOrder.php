<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampingOrder extends Model
{
    /** @use HasFactory<\Database\Factories\CampingOrderFactory> */
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campings()
    {
        return $this->belongsToMany(Camping::class, 'orders_camping_connection')
                    ->withPivot('quantity', 'totalprice');
    }
}
