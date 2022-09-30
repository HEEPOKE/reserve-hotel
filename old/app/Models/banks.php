<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banks extends Model
{
    use HasFactory;

    protected $table = 'company_payment_methods';
    protected $fillable = [
        'bank_name',
        'bank_code'
    ];
}
