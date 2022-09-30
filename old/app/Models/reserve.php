<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reserve extends Model
{
    use HasFactory;

    protected $table = 'reserve';
    protected $fillable = [
        'customer_id',
        'room_id',
        'guest_adult',
        'guest_child',
        'reserve_quantity',
        'start_in_room',
        'end_in_room',
        'payment_status',
        'payment_slip',
    ];
}
