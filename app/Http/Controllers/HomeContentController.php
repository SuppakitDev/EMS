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

class HomeContentController extends Controller
{
    public function getEmsOverviewDaily()
    {
        $currentDate = Date("Y-m-d");
        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
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
        $Totalenergythisday = $MaxApf - $MinApf;

        $Realtimepower = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
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
        ->Select(DB::raw('Max(Dis_date) as MaxDis_date'))
        ->get();

        foreach($Disdate as $Disdates )
         {
             $DisdateMax = $Disdates->MaxDis_date;
         }

        $view = view("Content/Manager/EmsOverviewDaily",[
            'Totalenergythisday' => $Totalenergythisday,
            'Realtimepower' => $Realtimepower,
            'Money_rate' => $Money_rate,
            'DisdateMax' => $DisdateMax,
        ])->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsOverviewMonthly()
    {
        $view = view("Content/Manager/EmsOverviewMonthly")->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsOverviewYearly()
    {
        $view = view("Content/Manager/EmsOverviewYearly")->render();
        return response()->json(['html'=>$view]);
    }

    public function EMSGettotalenergy()
    {
        header("Content-type: text/json");
        // ดึง Dis_date ที่น้อยที่สุดและมากที่สุดออกมา
        $currentMonth = date('m');
        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
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
        $Totalenergy = $MaxApf - $MinApf;
        return Response::json($Totalenergy, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function EMSGetrealtimepower()
    {
        header("Content-type: text/json");
        $Realtimepower = DB::table('ems_overview')
            ->where('C_ID','=',Auth::user()->C_ID)
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

    public function EMSGetlastPowerrealtimeDaily()
    {
        header("Content-type: text/json");

            $Date = Input::get('date');
            $RealtimepowerDaily = DB::table('ems_overview')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->whereDate('Dis_date' ,'=', Date($Date))
            ->SelectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , SUM(Pof) as y')
            ->groupBy('Dis_Date')
            ->get();
        return Response::json($RealtimepowerDaily, 200, [], JSON_NUMERIC_CHECK); 
    }

    public function EMSGetDepartmentConpare()
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
                        $query->select(DB::raw('MIN(Dis_Date)'))
                        ->whereDate('Dis_Date', '2018-11-19')
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
                        $Date = Input::get('date');
                        $query->select(DB::raw('MAX(Dis_Date)'))
                        ->whereDate('Dis_Date', $Date)
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

    public function EMSGetThisdayenergyOverview()
    {
        header("Content-type: text/json");
        $currentDate = Date("Y-m-d");
        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
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
        $Totalenergythisday = $MaxApf - $MinApf;
        return Response::json($Totalenergythisday, 200, [], JSON_NUMERIC_CHECK);
    }
    public function EMSGetlastupdatetime()
    {
        header("Content-type: text/json");
        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->Select(DB::raw('Max(Dis_date) as MaxDis_date'))
        ->get();

        foreach($Disdate as $Disdates )
         {
             $DisdateMax = $Disdates->MaxDis_date;
         }
         
         return Response::json($DisdateMax, 200, [], JSON_NUMERIC_CHECK);
    }

    public function EMSGetComparewithyesterday()
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

                $currentDate = Date("Y-m-d");                                                                       //ดึงค่าพลังงานในวันปัจจุบันออกมา
                $Disdate = DB::table('ems_overview')
                ->where('C_ID','=',Auth::user()->C_ID)
                ->where('D_ID','=',$ID)
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


                $YesterdayDate = Date("Y-m-d", time() - 86400);                                                     //ดึงค่าพลังงานของเมื่อวานออกมา
                // date_modify($YesterdayDate,"-1 day");
                $Disdate = DB::table('ems_overview')
                ->where('C_ID','=',Auth::user()->C_ID)
                ->where('D_ID','=',$ID)
                ->whereRaw('Date(Dis_date) = ?',[$YesterdayDate])
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
}
