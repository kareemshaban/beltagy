<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealsExit extends Model
{
    use HasFactory;
    protected $fillable =  [
        'id',
        'code',
        'meal_id',
        'item_id',
        'date',
        'quantity',
        'client_id',
        'outingTax',
        'duration',
        'notes',
        'paid',
        'remain',
        'isPaid',
        'type' ,
        'user_ins',
        'user_upd'

    ];
}
