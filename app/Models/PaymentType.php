<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'details',
        'user_ins',
        'user_upd'
    ];
}
