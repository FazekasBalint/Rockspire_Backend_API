<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TicketOrder extends Model
{
    /** @use HasFactory<\Database\Factories\TicketOrderFactory> */
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tickets that belong to the TicketOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'ticket_orders_connection')
                    ->withPivot('quantity', 'totalprice');
    }
}
