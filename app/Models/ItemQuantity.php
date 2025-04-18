<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemQuantity extends Model
{
    use HasFactory;
    protected  $fillable = [
      'id',
      'item_id',
      'quantity'
    ];
}
