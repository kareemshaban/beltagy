<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'name',
      'tag',
      'phone',
      'salary',
      'workHoursCount',
      'workDaysCount',
      'offWeaklyDay',
      'address',
      'department_id',
      'job_id',
      'user_ins',
       'user_upd'
    ];
}
