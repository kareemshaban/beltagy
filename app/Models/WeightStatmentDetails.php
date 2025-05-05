<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightStatmentDetails extends Model
{
    use HasFactory;

    protected $fillable = [
       'id',
       'weight_statment_id',
       'weight',
        'cell_index',
        'user_ins',
        'user_upd'
    ];
}
