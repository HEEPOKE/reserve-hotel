<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rooms extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    protected $fillable = [
        'company_id',
        'rooms_name',
        'room_detail',
        'room_facilities',
        'room_capacity',
        'room_quantity',
        'room_type',
        'price',
        'rooms_image'
      
    ];
}
