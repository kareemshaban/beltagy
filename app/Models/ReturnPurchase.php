<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'purchaseBillId',
        'billNumber',
        'date',
        'client_id',
        'total',
        'discount',
        'net',
        'paid',
        'remain',
        'isPaid',
        'notes',
        'user_ins',
        'user_upd'
    ];
}
