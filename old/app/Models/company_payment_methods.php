<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company_payment_methods extends Model
{
    use HasFactory;

    protected $table = 'company_payment_methods';
    protected $fillable = [
        'company_id',
        'payment_type',
        'bank_id',
        'bank_account_no'
    ];
}
