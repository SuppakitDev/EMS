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
         $company = DB::table('client_company')
         ->where('ID','=',Auth::user()->C_ID)
         ->select('C_name')
         ->get();
         foreach($company as $companys )
         {
             $companyname = $companys->C_name;
         }

        $view = view("Content/Manager/EmsOverviewDaily",[
            'Totalenergythisday' => $Totalenergythisday,
            'Realtimepower' => $Realtimepower,
            'Money_rate' => $Money_rate,
            'DisdateMax' => $DisdateMax,
            'companyname' => $companyname,
        ])->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsOverviewMonthly()
    {
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
        $company = DB::table('client_company')
        ->where('ID','=',Auth::user()->C_ID)
        ->select('C_name')
        ->get();
        foreach($company as $companys )
        {
            $companyname = $companys->C_name;
        }
        $view = view("Content/Manager/EmsOverviewMonthly",[
            'companyname' => $companyname,
            'TotalenergythisMonth' => $TotalenergythisMonth,
            'Realtimepower' => $Realtimepower,
            'Money_rate' => $Money_rate,
            'DisdateMax' => $DisdateMax,
        ])->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsOverviewYearly()
    {
        // $currentMonth = Date("m");
        $currentYear = Date("Y");
        $Disdate = DB::table('ems_overview')
        ->where('C_ID','=',Auth::user()->C_ID)
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
        $company = DB::table('client_company')
        ->where('ID','=',Auth::user()->C_ID)
        ->select('C_name')
        ->get();
        foreach($company as $companys )
        {
            $companyname = $companys->C_name;
        }
        $view = view("Content/Manager/EmsOverviewYearly",[
            'companyname' => $companyname,
            'TotalenergythisMonth' => $TotalenergythisMonth,
            'Realtimepower' => $Realtimepower,
            'Money_rate' => $Money_rate,
            'DisdateMax' => $DisdateMax,
        ])->render();
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
                        $Date = Input::get('date');

                        $query->select(DB::raw('MIN(Dis_Date)'))
                        ->whereDate('Dis_Date', $Date)
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

    public function EmsOverviewCustomDate()
    {
        $TypeSelect = Input::get('type-select');
        $Startdate = Input::get('Startdate');
        $Stopdate = Input::get('Stopdate');
       
        if($TypeSelect == "Power")
        {
            return view('Content/Manager/EmsOverviewCustomDatePower',
            [
                'Startdate' => $Startdate,
                'Stopdate' => $Stopdate,
              
            ]);
        }
        elseif($TypeSelect == "Energy")
        {
            return view('Content/Manager/EmsOverviewCustomDateEnergy',
            [
                'Startdate' => $Startdate,
                'Stopdate' => $Stopdate,
            ]);
        }
       
    }

    public function EmsgetOverviewPowerCustomDate()
    {
        header("Content-type: text/json");
            $Startdate = Input::get('Startdate');
            $Stopdate = Input::get('Stopdate');
            $RealtimepowerCustom = DB::table('ems_overview')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->whereDate('Dis_date', '<=', $Stopdate)
            ->whereDate('Dis_date', '>=', $Startdate)
            ->SelectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , SUM(Pof) as y')
            ->groupBy('Dis_Date')
            ->get();
        return Response::json($RealtimepowerCustom, 200, [], JSON_NUMERIC_CHECK); 
    }

    

    public function EmsgetOverviewEnergyCustomDate()
    {
        header("Content-type: text/json");
        $Startdate = Input::get('Startdate');
        $Stopdate = Input::get('Stopdate');
        $Date = Input::get('Date');
        // $currentYear = Date("Y", strtotime($Date));
        // $currentMonth = Date("m", strtotime($Date));
        $Date = DB::table('ems_overview')
            ->select(DB::Raw('DATE(Dis_date) as day'))
            ->where('C_ID','=',Auth::user()->C_ID)
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
}
