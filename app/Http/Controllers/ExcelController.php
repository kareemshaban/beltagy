<?php

namespace App\Http\Controllers;

use App\Imports\AttendImport;
use App\Imports\MonthClosingImport;
use App\Models\attend;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Vtiful\Kernel\Excel;

class ExcelController extends Controller
{
    public function import(Request $request)
    {

        $month = Carbon::now() -> month ;
        $year = Carbon::now() -> year ;

        $month_attends = Attend::whereMonth('date' , '=' , $month)
            -> whereYear('date' , '=' , $year)-> get();
        foreach ( $month_attends as $item) {
            $item -> delete();
        }
        $file = $request->file('file');

        FacadesExcel::import(new AttendImport(), $file , null ,   );




        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }


}
