<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;

    protected $fillable = ['type', 'price', 'availability'];

    public function orders()
    {
        return $this->belongsToMany(TicketOrder::class, 'tickets_orders_connection')
                    ->withPivot('quantity', 'totalprice');
    }
}
