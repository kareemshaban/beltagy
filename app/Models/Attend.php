<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'user_id',
      'date',
      'on_duty',
      'off_duty',
      'clock_in',
      'clock_out',
      'late',
      'early',
      'absent',
      'workTimeAdd',
      'workTime',
      'workTimeLate',
      'penaltyLate',
      'user_ins',
      'user_upd'
    ];
}
