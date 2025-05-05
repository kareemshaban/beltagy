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
        'requiredHours',
        'requiredMinutes',
        'actualHours',
        'actualMinutes',
        'lateHours',
        'lateMinutes',
        'additionalHours',
        'additionalMinutes',
        'rewardHours',
        'rewardMinutes',
        'deductionHours',
        'deductionMinutes',
        'rewardMoney',
        'deductionMoney',
        'advances',
        'netHours',
        'netMinutes',
        'salary',
        'netSalary',
        'user_ins',
        'user_upd'
    ];
}
