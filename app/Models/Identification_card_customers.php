<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identification_card_customers extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reserve_id',
        'name_prefixth',
        'name_prefixen',
        'first_nameth',
        'first_nameen',
        'last_nameth',
        'last_nameen',
        'identity_card',
        'birthdate',
        'inhabited',
        'soi',
        'tumbol',
        'street',
        'amphur',
        'province',
        'image_customer',
    ];

}
