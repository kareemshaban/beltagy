<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;
    protected $fillable = [
       'id',
       'user_id',
       'type', // 0 monthly , 1 payments
       'date',
       'amount',
       'monthlyPayment',
       'startDate',
       'paymentsCount',
       'remainPaymentsCount',
       'user_ins',
       'user_upd'
    ];
}
