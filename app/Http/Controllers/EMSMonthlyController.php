<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DB;
use Auth;
use App\ems_overview;
use App\User;
use App\client_company;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class EMSMonthlyController extends Controller
{
    public function MonthlyEnergychart()
    {
        header("Content-type: text/json");
        $Date = Input::get('Date');
        $currentYear = Date("Y", strtotime($Date));
        $currentMonth = Date("m", strtotime($Date));
        $Day = DB::table('ems_overview')
            ->select(DB::Raw('DATE(Dis_date) as day'))
            ->where('C_ID','=',Auth::user()->C_ID)
            ->whereYear('Dis_date', '=', $currentYear)
            ->whereMonth('Dis_date','=',$currentMonth)
            ->GroupBy('day')
            ->get();
        foreach($Day as $Days )
            {
                $Dayout = $Days->day;
               
                // $DateGraph = Date("d", strtotime($Dayout));
                $DateGraph = Date("d", strtotime($Dayout)- 86400);

                
                $Datetime = DB::table('ems_overview')
                        ->where('C_ID','=',Auth::user()->C_ID)
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

                $result[] = array($DateGraph,$Totalenergyeachday);

            }

        // return $result;
        return Response::json($result, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function EMSGetComparewithlastymonth()
    {
        header("Content-type: text/json");
        $Department = DB::table('department')                                                                       //ส่วนของดึงข้อมูลแผนกทั้งหมดในบริษัท
        ->where('C_ID','=',Auth::user()->C_ID)
        ->select('id','Dept_Name') 
        ->OrderBy('id')
        ->get();
        
        foreach($Department as $Departments)                                                                        //ลูปการทำงานโดยวงรอบการทำงานตามจำนวนแผนก                                                                            
        {
            $ID = $Departments->id;
            $Name[] = $Departments->Dept_Name;

                $currentMonth = Date("m");                                                                       //ดึงค่าพลังงานในวันปัจจุบันออกมา
                $currentYear = Date("Y");                                                                       //ดึงค่าพลังงานในวันปัจจุบันออกมา
                $Disdate = DB::table('ems_overview')
                ->where('C_ID','=',Auth::user()->C_ID)
                ->where('D_ID','=',$ID)
                ->whereRaw('Year(Dis_date) = ?',[$currentYear])
                ->whereRaw('Month(Dis_date) = ?',[$currentMonth])
                ->Select(DB::raw('Min(Dis_date) as MinDis_date'),DB::raw('Max(Dis_date) as MaxDis_date'))
                ->get();
                foreach($Disdate as $Disdates)
                {
                        $MaxDate = $Disdates->MaxDis_date;
                        $MinDate = $Disdates->MinDis_date;
                }
                // ทำการปรับเวลา เพื่อหลีกเลี่ยงกรณีข้อมูลชุดล่าสุดยังมาไม่ครบ ด้วยการ -5 นาที เพื่ือเอาข้อมูลชุดที่ครบถ้วน 
                $date = new DateTime($MaxDate);
                // $date->modify('-5 minutes');
                $MAXDISDATE =  $date->format('Y-m-d H:i:s');
                // ดึง Apf รวมของเวลาที่มากสุด
                $MaxApf = DB::table('ems_overview')
                ->where('C_ID','=',Auth::user()->C_ID)
                ->where('D_ID','=',$ID)
                ->where('Dis_date' ,'=',$MAXDISDATE)
                ->Select(DB::raw('SUM(Apf) as total_Apf'))
                ->groupBy('Dis_Date')
                ->get();
                // ดึง Apf รวมของเวลาที่น้อยสุด
                $MinApf = DB::table('ems_overview')
                ->where('C_ID','=',Auth::user()->C_ID)
                ->where('D_ID','=',$ID)
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
                $Totalenergythisday[] = $MaxApf - $MinApf;


                $LastMonth = date('m',strtotime("-1 month"));
                // $LastMonth->modify('-1 month');
                $currentYear = Date("Y");                                                     //ดึงค่าพลังงานของเมื่อวานออกมา
                // date_modify($YesterdayDate,"-1 day");
                $Disdate = DB::table('ems_overview')
                ->where('C_ID','=',Auth::user()->C_ID)
                ->where('D_ID','=',$ID)
                ->whereRaw('Year(Dis_date) = ?',[$currentYear])
                ->whereRaw('Month(Dis_date) = ?',[$LastMonth])
                ->Select(DB::raw('Min(Dis_date) as MinDis_date'),DB::raw('Max(Dis_date) as MaxDis_date'))
                ->get();
                foreach($Disdate as $Disdates)
                {
                        $MaxDate = $Disdates->MaxDis_date;
                        $MinDate = $Disdates->MinDis_date;
                }
                // ทำการปรับเวลา เพื่อหลีกเลี่ยงกรณีข้อมูลชุดล่าสุดยังมาไม่ครบ ด้วยการ -5 นาที เพื่ือเอาข้อมูลชุดที่ครบถ้วน 
                $date = new DateTime($MaxDate);
                
                $MAXDISDATE =  $date->format('Y-m-d H:i:s');
                // ดึง Apf รวมของเวลาที่มากสุด
                $MaxApf = DB::table('ems_overview')
                ->where('C_ID','=',Auth::user()->C_ID)
                ->where('D_ID','=',$ID)
                ->where('Dis_date' ,'=',$MAXDISDATE)
                ->Select(DB::raw('SUM(Apf) as total_Apf'))
                ->groupBy('Dis_Date')
                ->get();
                // ดึง Apf รวมของเวลาที่น้อยสุด
                $MinApf = DB::table('ems_overview')
                ->where('C_ID','=',Auth::user()->C_ID)
                ->where('D_ID','=',$ID)
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
                $Totalenergyyesterday[] = $MaxApf - $MinApf;
        }
        return Response::json([                                                                                        //ส่งกลับข้อมูลทั้ง 3 ตัวแปลกลับไปตามที่ Reauest มา
            'Name' => $Name,
            'Totalenergythisday' => $Totalenergythisday,
            'Totalenergyyesterday' => $Totalenergyyesterday,
        ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function EMSGetDepartmentConparethisMonth()
    {
        header("Content-type: text/json");
        
        $Department = DB::table('department')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->select('id','Dept_Name') 
        ->get();
        
        foreach($Department as $Departments)
        {
            $ID = $Departments->id;
            $Name = $Departments->Dept_Name;
           

            $ThistimeenergyMIN = DB::table('ems_overview')
                    ->where('C_ID','=',Auth::user()->C_ID)
                    ->where('D_ID','=',$ID)
                    ->where('Dis_Date','=',function($query){
                        $Year = Input::get('Year');
                        $Month = Input::get('Month');

                        $query->select(DB::raw('MIN(Dis_Date)'))
                        ->whereMonth('Dis_Date', $Month)
                        ->whereYear('Dis_Date', $Year)
                        ->from('ems_overview');
                    })
                    ->Select('Apf')
                    ->get();
                    foreach($ThistimeenergyMIN as $ThistimeenergyMINs )
                    {
                        $ThistimeenergyMIN = $ThistimeenergyMINs->Apf;
                    }    
            $ThistimeenergyMAX = DB::table('ems_overview')
                    ->where('C_ID','=',Auth::user()->C_ID)
                    ->where('D_ID','=',$ID)
                    ->where('Dis_Date','=',function($query){
                        $Year = Input::get('Year');
                        $Month = Input::get('Month');
                        $query->select(DB::raw('MAX(Dis_Date)'))
                        ->whereMonth('Dis_Date', $Month)
                        ->whereYear('Dis_Date', $Year)
                        ->from('ems_overview');
                    })
                    ->Select('Apf')
                    ->get();
                    foreach($ThistimeenergyMAX as $ThistimeenergyMAXs )
                    {
                        $ThistimeenergyMAX = $ThistimeenergyMAXs->Apf;
                    }    
            $Totalenergy = $ThistimeenergyMAX - $ThistimeenergyMIN;

            $result[] = array($Name,$Totalenergy);
        }
        return Response::json($result, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function EMSGetThisMonthenergyOverview()
    {
        header("Content-type: text/json");
        $currentMonth = Date("m");
        $currentYear = Date("Y");
        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
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
        ->where('Dis_date' ,'=',$MAXDISDATE)
        ->Select(DB::raw('SUM(Apf) as total_Apf'))
        ->groupBy('Dis_Date')
        ->get();
        // ดึง Apf รวมของเวลาที่น้อยสุด
        $MinApf = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
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
        $TotalenergythisMonth = $MaxApf - $MinApf;
        return Response::json($TotalenergythisMonth, 200, [], JSON_NUMERIC_CHECK);
    }

    public function MonthlyEnergychartInside()
    {
        header("Content-type: text/json");
        $Date = Input::get('Date');
        $DeptID = Input::get('DeptID');
        $currentYear = Date("Y", strtotime($Date));
        $currentMonth = Date("m", strtotime($Date));
        $Day = DB::table('ems_overview')
            ->select(DB::Raw('DATE(Dis_date) as day'))
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=',$DeptID)
            ->whereYear('Dis_date', '=', $currentYear)
            ->whereMonth('Dis_date','=',$currentMonth)
            ->GroupBy('day')
            ->get();
        foreach($Day as $Days )
            {
                $Dayout = $Days->day;
               
                // $DateGraph = Date("d", strtotime($Dayout));
                $DateGraph = Date("d", strtotime($Dayout)- 86400);

                
                $Datetime = DB::table('ems_overview')
                        ->where('C_ID','=',Auth::user()->C_ID)
                        ->where('D_ID','=',$DeptID)
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
                        ->where('D_ID','=',$DeptID)
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
                        ->where('D_ID','=',$DeptID)
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

                $result[] = array($DateGraph,$Totalenergyeachday);

            }

        // return $result;
        return Response::json($result, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function EMSGetThisMonthenergyInside()
    {
        header("Content-type: text/json");
        $DeptID = Input::get('DeptID');
        $currentMonth = Date("m");
        $currentYear = Date("Y");
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
        $TotalenergythisMonth = $MaxApf - $MinApf;
        return Response::json($TotalenergythisMonth, 200, [], JSON_NUMERIC_CHECK);
    }
}
