<?php

namespace App\Imports;

use App\Models\MonthClosing;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MonthClosingImport implements WithMultipleSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function sheets(): array
    {
        return ([

            // 'Schedule Infor.' => new AttendImport(),
            'Att. Stat.' => new AttendImport()
        ]);
    }




}
