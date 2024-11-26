<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
       'id' ,
       'apsents_hours_to_deduct_one_day',
       'user_ins',
       'user_upd'
    ];
}
