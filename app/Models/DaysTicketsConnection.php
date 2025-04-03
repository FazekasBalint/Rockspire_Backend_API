<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaysTicketsConnection extends Model
{
    /** @use HasFactory<\Database\Factories\DaysTicketsConnectionFactory> */
    use HasFactory;

    protected $table='days_tickets_connection';

    protected $fillable = ['ticket_id', 'day_id'];

}
