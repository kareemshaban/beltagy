<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'name',
      'phone',
      'address',
      'mobile',
      'phone2',
       'pricingType',  // 0 system prices , 1 private prices
       'enteringTaxPerBoxPerMonth',
        'coolingValuePerBoxPerMonth',
      'user_ins',
      'user_upd'

    ];
}
