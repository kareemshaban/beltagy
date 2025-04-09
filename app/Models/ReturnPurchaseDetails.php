<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnPurchaseDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'return_purchase_id',
        'date',
        'item_id',
        'quantity',
        'weight',
        'price',
        'total',
        'user_ins',
        'user_upd'
    ];
}
