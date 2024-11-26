<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthClosing extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'date',
        'user_id',
        'attend_days_count',
        'absence_days_count',
        'deductions_days_count',
        'bonse_days_count',
        'deductions_amount',
        'bonse_amount',
        'advance_amount',
        'net_salary',
        'user_ins',
        'user_upd'
    ];
}
