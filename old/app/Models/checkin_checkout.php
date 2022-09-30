<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkin_checkout extends Model
{
    use HasFactory;

    protected $table = 'checkin_checkout';
    protected $fillable = [
        'reserve_id',
        'stay_status',
        'walk_in_customers'
    ];
}
