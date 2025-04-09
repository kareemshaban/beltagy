<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
      'id',
      'item_id',
      'quantity_in',
      'quantity_out',
      'weight_in',
      'weight_out',
      'balance'
    ];
}
