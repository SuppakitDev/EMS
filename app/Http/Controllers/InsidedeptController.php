<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ems_overview;
use App\User;
use App\client_company;
use DB;
use DateTime;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class InsidedeptController extends Controller
{
    public function index()
    {
        $DeptID = Input::get('Deptid');
        $Building = DB::table('building')
                    ->where('C_ID','=',Auth::user()->C_ID)
                    ->get();
        
        $Department = DB::table('department')
                    ->where('C_ID','=',Auth::user()->C_ID)
                    ->get();
        $Deptdetail = DB::table('department')
                    ->where('C_ID','=',Auth::user()->C_ID)
                    ->where('id','=',$DeptID)
                    ->get();
                foreach($Deptdetail as $Deptdetails)
                    {
                        $Deptdetailname = $Deptdetails->Dept_Name;
                    }
        return view("Content/Manager/InsideDept",
        [
            'Building' => $Building,
            'Department' => $Department,
            'Deptdetailname' => $Deptdetailname,
        ]);
    }

    public function getEmsInsideDeptDaily()
    {
        $view = view("Content/Manager/EmsInsideDeptDaily")->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsInsideDeptMonthly()
    {
        $view = view("Content/Manager/EmsInsideDeptMonthly")->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsInsideDeptYearly()
    {
        $view = view("Content/Manager/EmsInsideDeptYearly")->render();
        return response()->json(['html'=>$view]);
    }
}
