<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionAndBonse extends Model
{
    use HasFactory;
    protected $fillable = [
       'id',
       'user_id',
       'date',
       'type', // 0 dudction 1 bonse
       'hours',
       'notes',
       'user_ins',
       'user_upd'
    ];
}
