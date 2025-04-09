<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaltingExit extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'code',
        'salting_enter_id',
        'item_id',
        'client_id',
        'date',
        'duration',
        'quantity',
        'weight',
        'serviceTotal',
        'paid',
        'remain',
        'isPaid',
        'cost',
        'losPerc',
        'notes',
        'user_ins',
        'user_upd',
        'type'
    ];
}
