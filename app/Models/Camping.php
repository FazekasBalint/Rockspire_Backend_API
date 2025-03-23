<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camping extends Model
{
    /** @use HasFactory<\Database\Factories\CampingFactory> */
    use HasFactory;

    protected $fillable = ['type', 'price','description', 'availability'];

    protected $table = 'camping';

    public function orders()
    {
        return $this->belongsToMany(CampingOrder::class, 'orders_camping_connection','order_id', 'camping_id')
                    ->withPivot('quantity', 'totalprice');
    }
}
