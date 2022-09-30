<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provider_payment_methods extends Model
{
    use HasFactory;

    protected $table = 'provider_payment_methods';
    protected $fillable = [
        'company_id',
        'payment_type',
        'bank_id',
        'bank_account_no'
    ];
}
