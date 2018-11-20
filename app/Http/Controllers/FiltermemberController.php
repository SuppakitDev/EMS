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
class FiltermemberController extends Controller
{
    public function Index()
    {
        if(Auth::user()->Status == "ADMIN")
        {
                $company = DB::table('client_company')
                ->where('ID','!=',0)
                ->get();
                return view('Content\Admin\Adminhome',
                [
                    'company' => $company,
                ]);
        }
        elseif(Auth::user()->Status == "MANAGER")
        {
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
                // $Realtimepower = 999;
                // $Chargeinthismonth = 562000;
                $Money_rate = DB::table('client_company')
                    ->where('id','=',Auth::user()->C_ID)
                    ->select('Money_rate')
                    ->get();
                    foreach($Money_rate as $Money_rates )
                    {
                        $Money_rate = $Money_rates->Money_rate;
                    }
                
                $company = DB::table('client_company')
                    ->where('ID','=',Auth::user()->C_ID)
                    ->select('C_name')
                    ->get();
                    foreach($company as $companys )
                    {
                        $companyname = $companys->C_name;
                    }

                    return view('Content\Manager\Managerhome',
                    [
                        'Totalenergy' => $Totalenergy,
                        'Realtimepower' => $Realtimepower,
                        'Money_rate' => $Money_rate,
                        'companyname' => $companyname,
                    ]);
        }
        elseif(Auth::user()->Status == "USER")
        {
                return view('Content\User\Userhome');
        }
    }

    // public function testquery()
    // {
    //     $currentMonth = date('m');
    //     $TotalEnergythismonth = DB::table('ems_overview')
    //     ->where('C_ID','=',Auth::user()->C_ID)
    //     ->whereRaw('MONTH(Dis_date) = ?',[$currentMonth])
    //     ->Select('Dis_Date',DB::raw('SUM(Apf) as total_Apf'))
    //     ->groupBy('Dis_Date')
    //     ->get();

    //     foreach($TotalEnergythismonth as $key=>$value) 
    //     {
    //         if($key == 0)
    //         {
    //             $MinApf = $value->total_Apf;
    //         }
    //         elseif($key == (sizeof($TotalEnergythismonth)-2))
    //         {
    //             $MaxApf = $value->total_Apf;
    //         }
    //     }
    //     $Totalenergy = $MaxApf - $MinApf;
    //     return $Totalenergy;
    // }

    public function testquery()
    {
        // // ดึง Dis_date ที่น้อยที่สุดและมากที่สุดออกมา
        // $currentMonth = date('m');
        // $Disdate = DB::table('ems_overview')
        // ->where('C_ID','=',Auth::user()->C_ID)
        // ->whereRaw('MONTH(Dis_date) = ?',[$currentMonth])
        // ->Select(DB::raw('Min(Dis_date) as MinDis_date'),DB::raw('Max(Dis_date) as MaxDis_date'))
        // ->get();
        // foreach($Disdate as $Disdates)
        // {
        //         $MaxDate = $Disdates->MaxDis_date;
        //         $MinDate = $Disdates->MinDis_date;
        // }
        // // ทำการปรับเวลา เพื่อหลีกเลี่ยงกรณีข้อมูลชุดล่าสุดยังมาไม่ครบ ด้วยการ -5 นาที เพื่ือเอาข้อมูลชุดที่ครบถ้วน 
        // $date = new DateTime($MaxDate);
        // $date->modify('-5 minutes');
        // $MAXDISDATE =  $date->format('Y-m-d H:i:s');
        // // ดึง Apf รวมของเวลาที่มากสุด
        // $MaxApf = DB::table('ems_overview')
        // ->where('C_ID','=',Auth::user()->C_ID)
        // ->where('Dis_date' ,'=',$MAXDISDATE)
        // ->Select(DB::raw('SUM(Apf) as total_Apf'))
        // ->groupBy('Dis_Date')
        // ->get();
        // // ดึง Apf รวมของเวลาที่น้อยสุด
        // $MinApf = DB::table('ems_overview')
        // ->where('C_ID','=',Auth::user()->C_ID)
        // ->where('Dis_date' ,'=',$MinDate)
        // ->Select(DB::raw('SUM(Apf) as total_Apf'))
        // ->groupBy('Dis_Date')
        // ->get();
        // // แยกข้อมูลออกจาก Array
        // foreach($MaxApf as $MaxApfs )
        // {
        //     $MaxApf = $MaxApfs->total_Apf;
        // }
        // // แยกข้อมูลออกจาก Array
        // foreach($MinApf as $MinApfs )
        // {
        //     $MinApf = $MinApfs->total_Apf;
        // }
        // // มากสุด - น้อยสุด เพื่อหาพลังงานทั้งหมด
        // $Totalenergy = $MaxApf - $MinApf;
        // return $Totalenergy;

        // $RTPowerout = DB::table('ems_overview')
        //     ->where('C_ID','=',Auth::user()->C_ID)
        //     ->where('Dis_Date','=',function($query){
        //         $query->select(DB::raw('MAX(Dis_Date)'))
        //         ->from('ems_overview');
        //     })
        //     ->Select(DB::raw('SUM(Pof) as total_Pof'))
        //     ->groupBy('Dis_Date')
        //     ->get();
        // return $RTPowerout;

        // $Money_rate = DB::table('client_company')
        //     ->where('id','=',Auth::user()->C_ID)
        //     ->select('Money_rate')
        //     ->get();
        //     foreach($Money_rate as $Money_rates )
        //     {
        //         $Money_rate = $Money_rates->Money_rate;
        //     }
        // return $Money_rate;

        // $Realtimepower = DB::table('ems_overview')
        // ->where('C_ID','=',Auth::user()->C_ID)
        // // ->where('Dis_Date','=',function($query){
        // //     $query->select(DB::raw('MAX(Dis_Date)'))
        // //     ->from('ems_overview');
        // // })
        // ->Select('Dis_Date as x',DB::raw('SUM(Pof) as y'))
        // ->groupBy('Dis_Date')
        // ->get();
        // // foreach($Realtimepower as $Realtimepowers )
        // // {
        // //     $Realtimepower = $Realtimepowers->total_Pof;
        // // }
        // return $Realtimepower;

        // $Department = DB::table('department')
        // ->where('C_ID','=',Auth::user()->C_ID)
        // ->select('id','Dept_Name') 
        // ->get();
        
        // foreach($Department as $Departments)
        // {
        //     $ID = $Departments->id;
        //     $Name = $Departments->Dept_Name;

        //     $ThistimeenergyMIN = DB::table('ems_overview')
        //             ->where('C_ID','=',Auth::user()->C_ID)
        //             ->where('D_ID','=',$ID)
        //             ->where('Dis_Date','=',function($query){
        //                 $query->select(DB::raw('MIN(Dis_Date)'))
        //                 ->whereDate('Dis_Date', '2018-11-19')
        //                 // ->where('D_ID','=',$ID)
        //                 ->from('ems_overview');
        //             })
        //             ->Select('Apf')
        //             // ->groupBy('Dis_Date')
        //             ->get();
        //             foreach($ThistimeenergyMIN as $ThistimeenergyMINs )
        //             {
        //                 $ThistimeenergyMIN = $ThistimeenergyMINs->Apf;
        //             }    
        //     $ThistimeenergyMAX = DB::table('ems_overview')
        //             ->where('C_ID','=',Auth::user()->C_ID)
        //             ->where('D_ID','=',$ID)
        //             ->where('Dis_Date','=',function($query){
        //                 $query->select(DB::raw('MAX(Dis_Date)'))
        //                 ->whereDate('Dis_Date', '2018-11-19')
        //                 // ->where('D_ID','=',$ID)
        //                 ->from('ems_overview');
        //             })
        //             ->Select('Apf')
        //             // ->groupBy('Dis_Date')
        //             ->get();
        //             foreach($ThistimeenergyMAX as $ThistimeenergyMAXs )
        //             {
        //                 $ThistimeenergyMAX = $ThistimeenergyMAXs->Apf;
        //             }    
        //     $Totalenergy = $ThistimeenergyMAX - $ThistimeenergyMIN;

        //     $result[] = array($Name,$Totalenergy);
        // }
        

        // return $result;

        // $currentDate = Date("Y-m-d");
        // $Disdate = DB::table('ems_overview')
        // ->where('C_ID','=',Auth::user()->C_ID)
        // ->whereRaw('Date(Dis_date) = ?',[$currentDate])
        // ->Select(DB::raw('Min(Dis_date) as MinDis_date'),DB::raw('Max(Dis_date) as MaxDis_date'))
        // ->get();
        // foreach($Disdate as $Disdates)
        // {
        //         $MaxDate = $Disdates->MaxDis_date;
        //         $MinDate = $Disdates->MinDis_date;
        // }
        // // ทำการปรับเวลา เพื่อหลีกเลี่ยงกรณีข้อมูลชุดล่าสุดยังมาไม่ครบ ด้วยการ -5 นาที เพื่ือเอาข้อมูลชุดที่ครบถ้วน 
        // $date = new DateTime($MaxDate);
        // $date->modify('-5 minutes');
        // $MAXDISDATE =  $date->format('Y-m-d H:i:s');
        // // ดึง Apf รวมของเวลาที่มากสุด
        // $MaxApf = DB::table('ems_overview')
        // ->where('C_ID','=',Auth::user()->C_ID)
        // ->where('Dis_date' ,'=',$MAXDISDATE)
        // ->Select(DB::raw('SUM(Apf) as total_Apf'))
        // ->groupBy('Dis_Date')
        // ->get();
        // // ดึง Apf รวมของเวลาที่น้อยสุด
        // $MinApf = DB::table('ems_overview')
        // ->where('C_ID','=',Auth::user()->C_ID)
        // ->where('Dis_date' ,'=',$MinDate)
        // ->Select(DB::raw('SUM(Apf) as total_Apf'))
        // ->groupBy('Dis_Date')
        // ->get();
        // // แยกข้อมูลออกจาก Array
        // foreach($MaxApf as $MaxApfs )
        // {
        //     $MaxApf = $MaxApfs->total_Apf;
        // }
        // // แยกข้อมูลออกจาก Array
        // foreach($MinApf as $MinApfs )
        // {
        //     $MinApf = $MinApfs->total_Apf;
        // }
        // // มากสุด - น้อยสุด เพื่อหาพลังงานทั้งหมด
        // $Totalenergy = $MaxApf - $MinApf;

        // return $Totalenergy;

        // $Disdate = DB::table('ems_overview')
        // ->where('C_ID','=',Auth::user()->C_ID)
        // ->Select(DB::raw('Max(Dis_date) as MaxDis_date'))
        // ->get();

        // foreach($Disdate as $Disdates )
        //  {
        //      $DisdateMax = $Disdates->MaxDis_date;
        //  }

        // return $DisdateMax;
        header("Content-type: text/json");
        $Department = DB::table('department')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->select('id','Dept_Name') 
        ->OrderBy('id')
        ->get();
        
        foreach($Department as $Departments)
        {
            $ID = $Departments->id;
            $Name[] = $Departments->Dept_Name;

                $currentDate = Date("Y-m-d");
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


                $YesterdayDate = Date("Y-m-d", time() - 86400);
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

        return Response::json([
            'Name' => $Name,
            'Totalenergythisday' => $Totalenergythisday,
            'Totalenergyyesterday' => $Totalenergyyesterday,
        ], 200, [], JSON_NUMERIC_CHECK);

    }
}


