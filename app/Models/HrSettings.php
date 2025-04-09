<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'allowLate',
        'allowEarly',
        'absentPenalty',
        'user_ins',
        'user_upd'
    ];
}
