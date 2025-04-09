<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected  $fillable = [
      'id',
      'client_id',
      'date',
      'amount',
      'notes',
      'type', // 0 enter 1 exit
      'operation_id' ,
      'user_ins',
      'user_upd'
    ];
}
