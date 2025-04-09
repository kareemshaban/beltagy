<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealsEnter extends Model
{
    use HasFactory;
    protected $fillable =  [
        'id',
        'code',
        'item_id',
        'date',
        'quantity',
        'client_id',
        'enteringTax',
        'outingQuantity',
        'notes',
        'paid',
        'remain',
        'isPaid',
        'type',
        'user_ins',
        'user_upd'

        ];
}
