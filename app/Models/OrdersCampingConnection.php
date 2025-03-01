<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersCampingConnection extends Model
{
    /** @use HasFactory<\Database\Factories\OrdersCampingConnectionFactory> */
    use HasFactory;

    protected $table = 'orders_camping_connection';

    protected $fillable = ['order_id', 'camping_id', 'quantity', 'totalprice'];
}
