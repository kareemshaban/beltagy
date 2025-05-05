<?php

namespace App\Imports;

use App\Models\attend;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AttendImport implements ToModel , WithStartRow , WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $tag = $row['ac_no'] ;
        $employee = Employee::where('tag', $tag)->first();
        if($employee){
            return new Attend([
                'user_id' => $employee-> id,
                'date' => Carbon::parse($row['date']),
                'on_duty' => $row['on_duty'],
                'off_duty' => $row['off_duty'],
                'clock_in' => $row['clock_in'],
                'clock_out' => $row['clock_out'],
                'late' => $row['late'],
                'early' => $row['early'],
                'absent' => strtolower($row['absent']),
                'workTimeAdd' => $row['ot_time'],
                'workTime' => $row['work_time'],
                'workTimeLate' => $row['late'],
                'penaltyLate' => $row['late'],
                'user_ins' => Auth::user()-> id ,
            ]);
        }

    }
    public function startRow(): int
    {
        return 2;
    }
}
