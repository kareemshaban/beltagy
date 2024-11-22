<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
      'id',
      'user_id',
      'date',
      'type', // 0 deduction 1 bonse
      'reward',
      'notes',
      'user_ins',
       'user_upd'
    ];
}
