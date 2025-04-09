<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaltingEnter extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'code',
        'item_id',
        'client_id',
        'date',
        'quantity',
        'weight',
        'outingQuantity',
        'outingWeight',
        'price',
        'total',
        'paid',
        'remain',
        'isPaid',
        'freshValue',
        'notes',
        'user_ins',
        'user_upd',
        'type'
    ];
}
