<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightStatment extends Model
{
    use HasFactory;

    protected $fillable = [
      'id',
      'meal_id',
      'client_id',
      'total_quantity',
      'date',
      'weight',
      'burlap_weight',
      'net_weight',
      'quantity',
      'price',
      'total',
      'user_ins',
      'user_upd'
    ];
}
