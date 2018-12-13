<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\CsvExportDaily;
use App\Exports\CsvExportMonthly;
use App\Exports\CsvExportYearly;
use App\Exports\CsvExportCustomdate;
use App\ems_info;
use Auth;
use DateTime;
use DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class EmsExportCsvController extends Controller
{
   
    public function CsvExportDaily()
    {

        $Date = Input::get('DaySelect');
        $Department = Input::get('DayDepartment');

        $data = DB::table('ems_info')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->whereIn('D_ID',$Department)
        ->whereRaw('Date(Dis_date) = ?',[$Date])
        ->get();

        $Deptname = DB::table('department')
        ->whereIn('id',$Department)
        ->Select('Dept_Name')
        ->get(); 

        $Name = "EmsDailyExport(".$Date.").xlsx";

        return Excel::download(new CsvExportDaily($data,$Date,$Deptname), $Name);
    }

    public function CsvExportMonthly()
    {

        $Month = Input::get('MonthSelect');
        $M = Date("m", strtotime($Month));
        $Y = Date("Y", strtotime($Month));

        $Department = Input::get('MonthDepartment');

        $data = DB::table('ems_info')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->whereIn('D_ID',$Department)
        ->whereMonth('Dis_date','=',$M)
        ->whereYear('Dis_date','=',$Y)
        ->get();

        $Deptname = DB::table('department')
        ->whereIn('id',$Department)
        ->Select('Dept_Name')
        ->get(); 

        $Name = "EmsMonthlyExport(".$Month.").xlsx";

        return Excel::download(new CsvExportMonthly($data,$Month,$Deptname), $Name);
    }


    public function CsvExportYearly()
    {

        $Year = Input::get('YearSelect');
        // $M = Date("m", strtotime($Month));
        // $Y = Date("Y", strtotime($Month));

        $Department = Input::get('YearDepartment');

        $data = DB::table('ems_info')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->whereIn('D_ID',$Department)
        ->whereYear('Dis_date','=',$Year)
        ->get();

        $Deptname = DB::table('department')
        ->whereIn('id',$Department)
        ->Select('Dept_Name')
        ->get(); 

        $Name = "EmsYearlyExport(".$Year.").xlsx";

        return Excel::download(new CsvExportYearly($data,$Year,$Deptname), $Name);
    }

    public function CsvExportCustomdate()
    {

        $Start = Input::get('CusSelectStart');
        $Stop = Input::get('CusSelectStop');
      

        $Department = Input::get('CusDepartment');

        $data = DB::table('ems_info')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->whereIn('D_ID',$Department)
        ->whereDate('Dis_date', '<=', $Stop)
        ->whereDate('Dis_date', '>=', $Start)
        ->get();

        $Deptname = DB::table('department')
        ->whereIn('id',$Department)
        ->Select('Dept_Name')
        ->get(); 

        $Name = "EmsCustomExport(".$Start." to ".$Stop.").xlsx";

        return Excel::download(new CsvExportCustomdate($data,$Start,$Stop,$Deptname), $Name);
    }
}
