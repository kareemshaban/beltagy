<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
       'id' ,
       'enteringTax',
       'monthly_cooling_tax_per_box',
       'user_ins',
       'user_upd'
    ];
}
