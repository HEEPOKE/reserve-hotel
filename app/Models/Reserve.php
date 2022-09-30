<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'company_id',
        'room_id',
        'type_room',
        'room_name',
        'guest_adult',
        'guest_child',
        'reserve_quantity',
        'start_in_room',
        'end_in_room',
        'payment_status',
        'payment_slip',
        'total_price',
    ];
}
