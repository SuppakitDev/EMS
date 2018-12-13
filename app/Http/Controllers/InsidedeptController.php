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
                        $DeptdetailID = $Deptdetails->id;
                    }
        
        $Money_rate = DB::table('client_company')
                    ->where('id','=',Auth::user()->C_ID)
                    ->select('Money_rate')
                    ->get();
                    foreach($Money_rate as $Money_rates )
                    {
                        $Money_rate = $Money_rates->Money_rate;
                    }

        return view("Content/Manager/InsideDept",
        [
            'Building' => $Building,
            'Department' => $Department,
            'Deptdetailname' => $Deptdetailname,
            'DeptdetailID' => $DeptdetailID,
            'Money_rate' => $Money_rate,
        ]);
    }

    public function getEmsInsideDeptDaily()
    {
        $currentDate = Date("Y-m-d");
        $DeptID = Input::get('DeptID');
        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->whereRaw('Date(Dis_date) = ?',[$currentDate])
        ->Select(DB::raw('Min(Dis_date) as MinDis_date'),DB::raw('Max(Dis_date) as MaxDis_date'))
        ->get();
        foreach($Disdate as $Disdates)
        {
                $MaxDate = $Disdates->MaxDis_date;
                $MinDate = $Disdates->MinDis_date;
        }
        // ทำการปรับเวลา เพื่อหลีกเลี่ยงกรณีข้อมูลชุดล่าสุดยังมาไม่ครบ ด้วยการ -5 นาที เพื่ือเอาข้อมูลชุดที่ครบถ้วน 
        $date = new DateTime($MaxDate);
        $date->modify('-5 minutes');
        $MAXDISDATE =  $date->format('Y-m-d H:i:s');
        // ดึง Apf รวมของเวลาที่มากสุด
        $MaxApf = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->where('Dis_date' ,'=',$MAXDISDATE)
        ->Select(DB::raw('SUM(Apf) as total_Apf'))
        ->groupBy('Dis_Date')
        ->get();
        // ดึง Apf รวมของเวลาที่น้อยสุด
        $MinApf = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->where('Dis_date' ,'=',$MinDate)
        ->Select(DB::raw('SUM(Apf) as total_Apf'))
        ->groupBy('Dis_Date')
        ->get();
        // แยกข้อมูลออกจาก Array
        foreach($MaxApf as $MaxApfs )
        {
            $MaxApf = $MaxApfs->total_Apf;
        }
        // แยกข้อมูลออกจาก Array
        foreach($MinApf as $MinApfs )
        {
            $MinApf = $MinApfs->total_Apf;
        }
        // มากสุด - น้อยสุด เพื่อหาพลังงานทั้งหมด
        $TotalInsideenergythisday = $MaxApf - $MinApf;

        $Realtimepower = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->where('Dis_Date','=',function($query){
            $query->select(DB::raw('MAX(Dis_Date)'))
            ->from('ems_overview');
        })
        ->Select(DB::raw('SUM(Pof) as total_Pof'))
        ->groupBy('Dis_Date')
        ->get();
        foreach($Realtimepower as $Realtimepowers )
        {
            $RealtimeInsidepower = $Realtimepowers->total_Pof;
        }

        $Money_rate = DB::table('client_company')
        ->where('id','=',Auth::user()->C_ID)
        ->select('Money_rate')
        ->get();
        foreach($Money_rate as $Money_rates )
        {
            $Money_rate = $Money_rates->Money_rate;
        }

        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->Select(DB::raw('Max(Dis_date) as MaxDis_date'))
        ->get();

        foreach($Disdate as $Disdates )
         {
             $DisdateMaxInside = $Disdates->MaxDis_date;
         }
        $Deptdetail = DB::table('department')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('id','=',$DeptID)
        ->get();
            foreach($Deptdetail as $Deptdetails)
                {
                    $Deptdetailname = $Deptdetails->Dept_Name;
                    $DeptdetailID = $Deptdetails->id;
                }
        $view = view("Content/Manager/EmsInsideDeptDaily",
        [
            'TotalInsideenergythisday' => $TotalInsideenergythisday,
            'RealtimeInsidepower' => $RealtimeInsidepower,
            'Money_rate' => $Money_rate,
            'DisdateMaxInside' => $DisdateMaxInside,
            'DeptdetailID' => $DeptdetailID,
        ])->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsInsideDeptMonthly()
    {
        $currentMonth = Date("m");
        $currentYear = Date("Y");
        $DeptID = Input::get('DeptID');
        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->whereRaw('Month(Dis_date) = ?',[$currentMonth])
        ->whereRaw('Year(Dis_date) = ?',[$currentYear])
        ->Select(DB::raw('Min(Dis_date) as MinDis_date'),DB::raw('Max(Dis_date) as MaxDis_date'))
        ->get();
        foreach($Disdate as $Disdates)
        {
                $MaxDate = $Disdates->MaxDis_date;
                $MinDate = $Disdates->MinDis_date;
        }
        // ทำการปรับเวลา เพื่อหลีกเลี่ยงกรณีข้อมูลชุดล่าสุดยังมาไม่ครบ ด้วยการ -5 นาที เพื่ือเอาข้อมูลชุดที่ครบถ้วน 
        $date = new DateTime($MaxDate);
        $date->modify('-5 minutes');
        $MAXDISDATE =  $date->format('Y-m-d H:i:s');
        // ดึง Apf รวมของเวลาที่มากสุด
        $MaxApf = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->where('Dis_date' ,'=',$MAXDISDATE)
        ->Select(DB::raw('SUM(Apf) as total_Apf'))
        ->groupBy('Dis_Date')
        ->get();
        // ดึง Apf รวมของเวลาที่น้อยสุด
        $MinApf = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->where('Dis_date' ,'=',$MinDate)
        ->Select(DB::raw('SUM(Apf) as total_Apf'))
        ->groupBy('Dis_Date')
        ->get();
        // แยกข้อมูลออกจาก Array
        foreach($MaxApf as $MaxApfs )
        {
            $MaxApf = $MaxApfs->total_Apf;
        }
        // แยกข้อมูลออกจาก Array
        foreach($MinApf as $MinApfs )
        {
            $MinApf = $MinApfs->total_Apf;
        }
        // มากสุด - น้อยสุด เพื่อหาพลังงานทั้งหมด
        $TotalInsideenergythismonth = $MaxApf - $MinApf;

        $Realtimepower = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->where('Dis_Date','=',function($query){
            $query->select(DB::raw('MAX(Dis_Date)'))
            ->from('ems_overview');
        })
        ->Select(DB::raw('SUM(Pof) as total_Pof'))
        ->groupBy('Dis_Date')
        ->get();
        foreach($Realtimepower as $Realtimepowers )
        {
            $RealtimeInsidepower = $Realtimepowers->total_Pof;
        }

        $Money_rate = DB::table('client_company')
        ->where('id','=',Auth::user()->C_ID)
        ->select('Money_rate')
        ->get();
        foreach($Money_rate as $Money_rates )
        {
            $Money_rate = $Money_rates->Money_rate;
        }

        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->Select(DB::raw('Max(Dis_date) as MaxDis_date'))
        ->get();

        foreach($Disdate as $Disdates )
         {
             $DisdateMaxInside = $Disdates->MaxDis_date;
         }
        $Deptdetail = DB::table('department')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('id','=',$DeptID)
        ->get();
            foreach($Deptdetail as $Deptdetails)
                {
                    $Deptdetailname = $Deptdetails->Dept_Name;
                    $DeptdetailID = $Deptdetails->id;
                }
        $view = view("Content/Manager/EmsInsideDeptMonthly",
        [
            'TotalInsideenergythismonth' => $TotalInsideenergythismonth,
            'RealtimeInsidepower' => $RealtimeInsidepower,
            'Money_rate' => $Money_rate,
            'DisdateMaxInside' => $DisdateMaxInside,
            'DeptdetailID' => $DeptdetailID,
            'Deptdetailname' => $Deptdetailname,
        ])->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsInsideDeptYearly()
    {
        // $currentMonth = Date("m");
        $currentYear = Date("Y");
        $DeptID = Input::get('DeptID');
        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        // ->whereRaw('Month(Dis_date) = ?',[$currentMonth])
        ->whereRaw('Year(Dis_date) = ?',[$currentYear])
        ->Select(DB::raw('Min(Dis_date) as MinDis_date'),DB::raw('Max(Dis_date) as MaxDis_date'))
        ->get();
        foreach($Disdate as $Disdates)
        {
                $MaxDate = $Disdates->MaxDis_date;
                $MinDate = $Disdates->MinDis_date;
        }
        // ทำการปรับเวลา เพื่อหลีกเลี่ยงกรณีข้อมูลชุดล่าสุดยังมาไม่ครบ ด้วยการ -5 นาที เพื่ือเอาข้อมูลชุดที่ครบถ้วน 
        $date = new DateTime($MaxDate);
        $date->modify('-5 minutes');
        $MAXDISDATE =  $date->format('Y-m-d H:i:s');
        // ดึง Apf รวมของเวลาที่มากสุด
        $MaxApf = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->where('Dis_date' ,'=',$MAXDISDATE)
        ->Select(DB::raw('SUM(Apf) as total_Apf'))
        ->groupBy('Dis_Date')
        ->get();
        // ดึง Apf รวมของเวลาที่น้อยสุด
        $MinApf = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->where('Dis_date' ,'=',$MinDate)
        ->Select(DB::raw('SUM(Apf) as total_Apf'))
        ->groupBy('Dis_Date')
        ->get();
        // แยกข้อมูลออกจาก Array
        foreach($MaxApf as $MaxApfs )
        {
            $MaxApf = $MaxApfs->total_Apf;
        }
        // แยกข้อมูลออกจาก Array
        foreach($MinApf as $MinApfs )
        {
            $MinApf = $MinApfs->total_Apf;
        }
        // มากสุด - น้อยสุด เพื่อหาพลังงานทั้งหมด
        $TotalInsideenergythismonth = $MaxApf - $MinApf;

        $Realtimepower = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->where('Dis_Date','=',function($query){
            $query->select(DB::raw('MAX(Dis_Date)'))
            ->from('ems_overview');
        })
        ->Select(DB::raw('SUM(Pof) as total_Pof'))
        ->groupBy('Dis_Date')
        ->get();
        foreach($Realtimepower as $Realtimepowers )
        {
            $RealtimeInsidepower = $Realtimepowers->total_Pof;
        }

        $Money_rate = DB::table('client_company')
        ->where('id','=',Auth::user()->C_ID)
        ->select('Money_rate')
        ->get();
        foreach($Money_rate as $Money_rates )
        {
            $Money_rate = $Money_rates->Money_rate;
        }

        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->Select(DB::raw('Max(Dis_date) as MaxDis_date'))
        ->get();

        foreach($Disdate as $Disdates )
         {
             $DisdateMaxInside = $Disdates->MaxDis_date;
         }
        $Deptdetail = DB::table('department')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('id','=',$DeptID)
        ->get();
            foreach($Deptdetail as $Deptdetails)
                {
                    $Deptdetailname = $Deptdetails->Dept_Name;
                    $DeptdetailID = $Deptdetails->id;
                }
        $view = view("Content/Manager/EmsInsideDeptYearly",
        [
            'TotalInsideenergythismonth' => $TotalInsideenergythismonth,
            'RealtimeInsidepower' => $RealtimeInsidepower,
            'Money_rate' => $Money_rate,
            'DisdateMaxInside' => $DisdateMaxInside,
            'DeptdetailID' => $DeptdetailID,
            'Deptdetailname' => $Deptdetailname,
        ])->render();
        return response()->json(['html'=>$view]);
    }


    public function EMSGetInsideRealtimepowerDaily()
    {
        header("Content-type: text/json");

            $Date = Input::get('date');
            $DeptID = Input::get('DeptID');
            $RealtimepowerDaily = DB::table('ems_overview')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=',$DeptID)
            ->whereDate('Dis_date' ,'=', Date($Date))
            ->SelectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , Pof as y')
            // ->groupBy('Dis_Date')
            ->OrderBy('Dis_Date')
            ->get();
        return Response::json($RealtimepowerDaily, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function EMSGettotalInsideenergy()
    {
        header("Content-type: text/json");
        // ดึง Dis_date ที่น้อยที่สุดและมากที่สุดออกมา
        $DeptID = Input::get('DeptID');
        $currentMonth = date('m');
        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->whereRaw('MONTH(Dis_date) = ?',[$currentMonth])
        ->Select(DB::raw('Min(Dis_date) as MinDis_date'),DB::raw('Max(Dis_date) as MaxDis_date'))
        ->get();
        foreach($Disdate as $Disdates)
        {
                $MaxDate = $Disdates->MaxDis_date;
                $MinDate = $Disdates->MinDis_date;
        }
        // ทำการปรับเวลา เพื่อหลีกเลี่ยงกรณีข้อมูลชุดล่าสุดยังมาไม่ครบ ด้วยการ -5 นาที เพื่ือเอาข้อมูลชุดที่ครบถ้วน 
        $date = new DateTime($MaxDate);
        $date->modify('-5 minutes');
        $MAXDISDATE =  $date->format('Y-m-d H:i:s');
        // ดึง Apf รวมของเวลาที่มากสุด
        $MaxApf = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->where('Dis_date' ,'=',$MAXDISDATE)
        ->Select(DB::raw('SUM(Apf) as total_Apf'))
        ->groupBy('Dis_Date')
        ->get();
        // ดึง Apf รวมของเวลาที่น้อยสุด
        $MinApf = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->where('Dis_date' ,'=',$MinDate)
        ->Select(DB::raw('SUM(Apf) as total_Apf'))
        ->groupBy('Dis_Date')
        ->get();
        // แยกข้อมูลออกจาก Array
        foreach($MaxApf as $MaxApfs )
        {
            $MaxApf = $MaxApfs->total_Apf;
        }
        // แยกข้อมูลออกจาก Array
        foreach($MinApf as $MinApfs )
        {
            $MinApf = $MinApfs->total_Apf;
        }
        // มากสุด - น้อยสุด เพื่อหาพลังงานทั้งหมด
        $Totalenergy = $MaxApf - $MinApf;
        return Response::json($Totalenergy, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function EMSGetrealtimeInsidepower()
    {
        header("Content-type: text/json");
        $DeptID = Input::get('DeptID');
        $Realtimepower = DB::table('ems_overview')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=',$DeptID)
            ->where('Dis_Date','=',function($query){
                $query->select(DB::raw('MAX(Dis_Date)'))
                ->from('ems_overview');
            })
            ->Select(DB::raw('SUM(Pof) as total_Pof'))
            ->groupBy('Dis_Date')
            ->get();
            foreach($Realtimepower as $Realtimepowers )
            {
                $Realtimepower = $Realtimepowers->total_Pof;
            }
            return Response::json($Realtimepower, 200, [], JSON_NUMERIC_CHECK); 
    }
    public function EMSGetlastupdatetimeInside()
    {
        header("Content-type: text/json");
        $DeptID = Input::get('DeptID');
        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->where('D_ID','=',$DeptID)
        ->Select(DB::raw('Max(Dis_date) as MaxDis_date'))
        ->get();

        foreach($Disdate as $Disdates )
         {
             $DisdateMax = $Disdates->MaxDis_date;
         }
         
         return Response::json($DisdateMax, 200, [], JSON_NUMERIC_CHECK);
    }

    public function EmsInsideString1()
    {
        header("Content-type: text/json");
        
  
            $Dept_id = Input::get('Dept_id');
            $String1 = DB::table('ems_info')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=' ,$Dept_id)
            ->select('Ln1','Pof1','Vrms1','Irms1','PF1')
            ->latest()
            ->limit(1)
            ->get();
         
           
          
            return Response::json($String1, 200, [], JSON_NUMERIC_CHECK);
    }
    public function EmsInsideString2()
    {
        header("Content-type: text/json");
        
  
            $Dept_id = Input::get('Dept_id');
            $String2 = DB::table('ems_info')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=' ,$Dept_id)
            ->select('Ln2','Pof2','Vrms2','Irms2','PF2')
            ->latest()
            ->limit(1)
            ->get();
         
           
          
            return Response::json($String2, 200, [], JSON_NUMERIC_CHECK);
    }

    public function EmsInsideString3()
    {
        header("Content-type: text/json");
        
  
            $Dept_id = Input::get('Dept_id');
            $String3 = DB::table('ems_info')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=' ,$Dept_id)
            ->select('Ln3','Pof3','Vrms3','Irms3','PF3')
            ->latest()
            ->limit(1)
            ->get();
         
           
          
            return Response::json($String3, 200, [], JSON_NUMERIC_CHECK);
    }
    

    public function EmsInsideString4()
    {
        header("Content-type: text/json");
        
  
            $Dept_id = Input::get('Dept_id');
            $String4 = DB::table('ems_info')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=' ,$Dept_id)
            ->select('Ln4','Pof4','Vrms4','Irms4','PF4')
            ->latest()
            ->limit(1)
            ->get();
         
           
          
            return Response::json($String4, 200, [], JSON_NUMERIC_CHECK);
    }

    public function EmsInsideString5()
    {
        header("Content-type: text/json");
        
  
            $Dept_id = Input::get('Dept_id');
            $String5 = DB::table('ems_info')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=' ,$Dept_id)
            ->select('Ln5','Pof5','Vrms5','Irms5','PF5')
            ->latest()
            ->limit(1)
            ->get();
         
           
          
            return Response::json($String5, 200, [], JSON_NUMERIC_CHECK);
    }
    
    public function EmsInsideCustomDate()
    {
        $TypeSelect = Input::get('type-select');
        $Startdate = Input::get('Startdate');
        $Stopdate = Input::get('Stopdate');
        $Dept_ID = Input::get('Dept_ID');
        $Dept_Name = Input::get('Dept_Name');
       
        if($TypeSelect == "Power")
        {
            return view('Content/Manager/EmsInsideCustomDatePower',
            [
                'Startdate' => $Startdate,
                'Stopdate' => $Stopdate,
                'Dept_ID' => $Dept_ID,
                'Dept_Name' => $Dept_Name,
              
            ]);
        }
        elseif($TypeSelect == "Energy")
        {
            return view('Content/Manager/EmsInsideCustomDateEnergy',
            [
                'Startdate' => $Startdate,
                'Stopdate' => $Stopdate,
                'Dept_ID' => $Dept_ID,
                'Dept_Name' => $Dept_Name,

            ]);
        }
       
    }


    public function EmsgetInsidePowerCustomDate()
    {
        header("Content-type: text/json");
            $Startdate = Input::get('Startdate');
            $Stopdate = Input::get('Stopdate');
            $Dept_ID = Input::get('Dept_ID');
            $RealtimepowerCustom = DB::table('ems_overview')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=' ,$Dept_ID)
            ->whereDate('Dis_date', '<=', $Stopdate)
            ->whereDate('Dis_date', '>=', $Startdate)
            ->SelectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , SUM(Pof) as y')
            ->groupBy('Dis_Date')
            ->get();
        return Response::json($RealtimepowerCustom, 200, [], JSON_NUMERIC_CHECK); 
    }

    

    public function EmsgetInsideEnergyCustomDate()
    {
        header("Content-type: text/json");
        $Startdate = Input::get('Startdate');
        $Stopdate = Input::get('Stopdate');
        $Date = Input::get('Date');
        $Dept_ID = Input::get('Dept_ID');
        // $currentYear = Date("Y", strtotime($Date));
        // $currentMonth = Date("m", strtotime($Date));
        $Date = DB::table('ems_overview')
            ->select(DB::Raw('DATE(Dis_date) as day'))
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=' ,$Dept_ID)
            // ->whereYear('Dis_date', '=', $currentYear)
            // ->whereMonth('Dis_date','=',$currentMonth)
            ->whereDate('Dis_date', '<=', $Stopdate)
            ->whereDate('Dis_date', '>=', $Startdate)
            ->GroupBy('day')
            ->get();
        foreach($Date as $Dates )
            {
                $Dayout = $Dates->day;
               
                // $DateGraph = Date("d", strtotime($Dayout));
                // $DateGraph = Date("d", strtotime($Dayout)- 86400);

                
                $Datetime = DB::table('ems_overview')
                        ->where('C_ID','=',Auth::user()->C_ID)
                        ->where('D_ID','=' ,$Dept_ID)
                        ->whereDate('Dis_date','=',$Dayout)
                        ->select(DB::Raw('MAX(Dis_date) as Maxdatetime, MIN(Dis_date) as Mindatetime'))
                        ->get();
                foreach($Datetime as $Datetimes)
                {
                    $Maxdisdate = $Datetimes->Maxdatetime;
                    $Mindisdate = $Datetimes->Mindatetime;
                }

                $Maxenergyeachday = DB::table('ems_overview')

                        ->where('C_ID','=',Auth::user()->C_ID)
                        ->where('D_ID','=' ,$Dept_ID)
                        ->where('Dis_date','=',$Maxdisdate) 
                        // ->orWhere('Dis_date','=', $Mindisdate)
                        ->select(DB::raw('SUM(Apf) as Maxapf'))
                        ->GroupBy('Dis_date')
                        ->get();
                foreach($Maxenergyeachday as $Maxenergyeachdays)
                        {
                            $Maxenergyeachday = $Maxenergyeachdays->Maxapf;
                        }
                
                $Minenergyeachday = DB::table('ems_overview')

                        ->where('C_ID','=',Auth::user()->C_ID)
                        ->where('D_ID','=' ,$Dept_ID)
                        // ->where('Dis_date','=',$Maxdisdate) 
                        ->Where('Dis_date','=', $Mindisdate)
                        ->select(DB::raw('SUM(Apf) as Minapf'))
                        ->GroupBy('Dis_date')
                        ->get();
                
                foreach($Minenergyeachday as $Minenergyeachdays)
                    {
                        $Minenergyeachday = $Minenergyeachdays->Minapf;
                    }

                $Totalenergyeachday = $Maxenergyeachday - $Minenergyeachday;

                $result[] = array($Dayout,$Totalenergyeachday);

            }
            // $datestart = '2018-11-22';
            // $datestop = '2018-11-30';
            $Start = Date("Y-m-d", strtotime($Startdate));
            $Stop = Date("Y-m-d", strtotime($Stopdate));

            for($st = $Start ; $st <= $Stop ; $st = Date("Y-m-d", strtotime($st)+ 86400) )
            {
                $ar = $st;
                $resultplot[] = array($ar,null);
            }
           
        //   dump($resultplot);

        // return $result;
        return Response::json(['result' => $result,
                                'resultplot' => $resultplot,                            
                                ], 200, [], JSON_NUMERIC_CHECK); 
    }

    public function VoltageRealtime()
    {
        $Dept_ID = Input::get('Dept_ID');
        $Dept_Name = Input::get('Dept_Name');

        return view('Content/Manager/EmsInsideVoltageRealtime',
        [
            'Dept_ID' => $Dept_ID,
            'Dept_Name' => $Dept_Name,

        ]);

    }

    public function CurrentRealtime()
    {
        $Dept_ID = Input::get('Dept_ID');
        $Dept_Name = Input::get('Dept_Name');

        return view('Content/Manager/EmsInsideCurrentRealtime',
        [
            'Dept_ID' => $Dept_ID,
            'Dept_Name' => $Dept_Name,

        ]);
        
    }

    public function EmsgetVoltageRealtime()
    {
        header("Content-type: text/json");
        $C_ID = Auth::user()->C_ID;
        $Dept_ID = Input::get('Dept_ID');
        $currentDate = Date("Y-m-d");
    $RealtimeVoltage1 = DB::table('ems_info')
        ->where('C_ID','=',$C_ID)
        ->where('D_ID','=' ,$Dept_ID)
        ->whereDate('Dis_date', '=', $currentDate)
        ->selectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , Vrms1 as y')
        ->OrderBy('x')
        ->get();
    $RealtimeVoltage2 = DB::table('ems_info')
        ->where('C_ID','=',$C_ID)
        ->where('D_ID','=' ,$Dept_ID)
        ->whereDate('Dis_date', '=', $currentDate)
        ->selectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , Vrms2 as y')
        ->OrderBy('x')
        ->get();
    $RealtimeVoltage3 = DB::table('ems_info')
        ->where('C_ID','=',$C_ID)
        ->where('D_ID','=' ,$Dept_ID)
        ->whereDate('Dis_date', '=', $currentDate)
        ->selectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , Vrms3 as y')
        ->OrderBy('x')
        ->get();
    $RealtimeVoltage4 = DB::table('ems_info')
        ->where('C_ID','=',$C_ID)
        ->where('D_ID','=' ,$Dept_ID)
        ->whereDate('Dis_date', '=', $currentDate)
        ->selectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , Vrms4 as y')
        ->OrderBy('x')
        ->get();
    $RealtimeVoltage5 = DB::table('ems_info')
        ->where('C_ID','=',$C_ID)
        ->where('D_ID','=' ,$Dept_ID)
        ->whereDate('Dis_date', '=', $currentDate)
        ->selectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , Vrms5 as y')
        ->OrderBy('x')
        ->get();

        $Result = array($RealtimeVoltage1,$RealtimeVoltage2,$RealtimeVoltage3,$RealtimeVoltage4,$RealtimeVoltage5);

        return Response::json($Result, 200, [], JSON_NUMERIC_CHECK);
    }


    public function EmsgetCurrentRealtime()
    {
        header("Content-type: text/json");
        $C_ID = Auth::user()->C_ID;
        $Dept_ID = Input::get('Dept_ID');
        $currentDate = Date("Y-m-d");

            $RealtimeCurrent1 = DB::table('ems_info')
                ->where('C_ID','=',$C_ID)
                ->where('D_ID','=' ,$Dept_ID)
                ->whereDate('Dis_date', '=', $currentDate)
                ->selectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , Irms1 as y')
                ->OrderBy('x')
                ->get();
            $RealtimeCurrent2 = DB::table('ems_info')
                ->where('C_ID','=',$C_ID)
                ->where('D_ID','=' ,$Dept_ID)
                ->whereDate('Dis_date', '=', $currentDate)
                ->selectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , Irms2 as y')
                ->OrderBy('x')
                ->get();
            $RealtimeCurrent3 = DB::table('ems_info')
                ->where('C_ID','=',$C_ID)
                ->where('D_ID','=' ,$Dept_ID)
                ->whereDate('Dis_date', '=', $currentDate)
                ->selectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , Irms3 as y')
                ->OrderBy('x')
                ->get();
            $RealtimeCurrent4 = DB::table('ems_info')
                ->where('C_ID','=',$C_ID)
                ->where('D_ID','=' ,$Dept_ID)
                ->whereDate('Dis_date', '=', $currentDate)
                ->selectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , Irms4 as y')
                ->OrderBy('x')
                ->get();
            $RealtimeCurrent5 = DB::table('ems_info')
                ->where('C_ID','=',$C_ID)
                ->where('D_ID','=' ,$Dept_ID)
                ->whereDate('Dis_date', '=', $currentDate)
                ->selectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , Irms5 as y')
                ->OrderBy('x')
                ->get();

        $Result = array($RealtimeCurrent1,$RealtimeCurrent2,$RealtimeCurrent3,$RealtimeCurrent4,$RealtimeCurrent5);

        return Response::json($Result, 200, [], JSON_NUMERIC_CHECK);
    }

}
