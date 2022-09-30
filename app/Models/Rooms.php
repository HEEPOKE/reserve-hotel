<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Rooms extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'room_name',
        'room_detail',
        'room_facilities',
        'room_capacity',
        'room_quantity',
        'room_type',
        'price',
        'more_detail',
        'rooms_image',
        'other',
        'other_quantity',
        'other_price',
    ];
}
