<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnSales extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'salesBillId',
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
