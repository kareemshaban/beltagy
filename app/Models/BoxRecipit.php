<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxRecipit extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'billNumber',
       'safe_id',
      'date',
      'payment_type',
      'amount',
      'notes',
      'user_ins',
      'user_upd',
        'type',
    ];
}
