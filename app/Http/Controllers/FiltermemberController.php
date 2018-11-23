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

                $Building = DB::table('building')
                    ->where('C_ID','=',Auth::user()->C_ID)
                    ->get();
        
                $Department = DB::table('department')
                    ->where('C_ID','=',Auth::user()->C_ID)
                    ->get();
                    return view('Content\Manager\Managerhome',
                    [
                        'Totalenergy' => $Totalenergy,
                        'Realtimepower' => $Realtimepower,
                        'Money_rate' => $Money_rate,
                        'companyname' => $companyname,
                        'Building' => $Building,
                        'Department' => $Department,
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
        // header("Content-type: text/json");
        // $Department = DB::table('department')
        // ->where('C_ID','=',Auth::user()->C_ID)
        // ->select('id','Dept_Name') 
        // ->OrderBy('id')
        // ->get();
        
        // foreach($Department as $Departments)
        // {
        //     $ID = $Departments->id;
        //     $Name[] = $Departments->Dept_Name;

        //         $currentDate = Date("Y-m-d");
        //         $Disdate = DB::table('ems_overview')
        //         ->where('C_ID','=',Auth::user()->C_ID)
        //         ->where('D_ID','=',$ID)
        //         ->whereRaw('Date(Dis_date) = ?',[$currentDate])
        //         ->Select(DB::raw('Min(Dis_date) as MinDis_date'),DB::raw('Max(Dis_date) as MaxDis_date'))
        //         ->get();
        //         foreach($Disdate as $Disdates)
        //         {
        //                 $MaxDate = $Disdates->MaxDis_date;
        //                 $MinDate = $Disdates->MinDis_date;
        //         }
        //         // ทำการปรับเวลา เพื่อหลีกเลี่ยงกรณีข้อมูลชุดล่าสุดยังมาไม่ครบ ด้วยการ -5 นาที เพื่ือเอาข้อมูลชุดที่ครบถ้วน 
        //         $date = new DateTime($MaxDate);
        //         $date->modify('-5 minutes');
        //         $MAXDISDATE =  $date->format('Y-m-d H:i:s');
        //         // ดึง Apf รวมของเวลาที่มากสุด
        //         $MaxApf = DB::table('ems_overview')
        //         ->where('C_ID','=',Auth::user()->C_ID)
        //         ->where('D_ID','=',$ID)
        //         ->where('Dis_date' ,'=',$MAXDISDATE)
        //         ->Select(DB::raw('SUM(Apf) as total_Apf'))
        //         ->groupBy('Dis_Date')
        //         ->get();
        //         // ดึง Apf รวมของเวลาที่น้อยสุด
        //         $MinApf = DB::table('ems_overview')
        //         ->where('C_ID','=',Auth::user()->C_ID)
        //         ->where('D_ID','=',$ID)
        //         ->where('Dis_date' ,'=',$MinDate)
        //         ->Select(DB::raw('SUM(Apf) as total_Apf'))
        //         ->groupBy('Dis_Date')
        //         ->get();
        //         // แยกข้อมูลออกจาก Array
        //         foreach($MaxApf as $MaxApfs )
        //         {
        //             $MaxApf = $MaxApfs->total_Apf;
        //         }
        //         // แยกข้อมูลออกจาก Array
        //         foreach($MinApf as $MinApfs )
        //         {
        //             $MinApf = $MinApfs->total_Apf;
        //         }
        //         // มากสุด - น้อยสุด เพื่อหาพลังงานทั้งหมด
        //         $Totalenergythisday[] = $MaxApf - $MinApf;


        //         $YesterdayDate = Date("Y-m-d", time() - 86400);
        //         // date_modify($YesterdayDate,"-1 day");
        //         $Disdate = DB::table('ems_overview')
        //         ->where('C_ID','=',Auth::user()->C_ID)
        //         ->where('D_ID','=',$ID)
        //         ->whereRaw('Date(Dis_date) = ?',[$YesterdayDate])
        //         ->Select(DB::raw('Min(Dis_date) as MinDis_date'),DB::raw('Max(Dis_date) as MaxDis_date'))
        //         ->get();
        //         foreach($Disdate as $Disdates)
        //         {
        //                 $MaxDate = $Disdates->MaxDis_date;
        //                 $MinDate = $Disdates->MinDis_date;
        //         }
        //         // ทำการปรับเวลา เพื่อหลีกเลี่ยงกรณีข้อมูลชุดล่าสุดยังมาไม่ครบ ด้วยการ -5 นาที เพื่ือเอาข้อมูลชุดที่ครบถ้วน 
        //         $date = new DateTime($MaxDate);
                
        //         $MAXDISDATE =  $date->format('Y-m-d H:i:s');
        //         // ดึง Apf รวมของเวลาที่มากสุด
        //         $MaxApf = DB::table('ems_overview')
        //         ->where('C_ID','=',Auth::user()->C_ID)
        //         ->where('D_ID','=',$ID)
        //         ->where('Dis_date' ,'=',$MAXDISDATE)
        //         ->Select(DB::raw('SUM(Apf) as total_Apf'))
        //         ->groupBy('Dis_Date')
        //         ->get();
        //         // ดึง Apf รวมของเวลาที่น้อยสุด
        //         $MinApf = DB::table('ems_overview')
        //         ->where('C_ID','=',Auth::user()->C_ID)
        //         ->where('D_ID','=',$ID)
        //         ->where('Dis_date' ,'=',$MinDate)
        //         ->Select(DB::raw('SUM(Apf) as total_Apf'))
        //         ->groupBy('Dis_Date')
        //         ->get();
        //         // แยกข้อมูลออกจาก Array
        //         foreach($MaxApf as $MaxApfs )
        //         {
        //             $MaxApf = $MaxApfs->total_Apf;
        //         }
        //         // แยกข้อมูลออกจาก Array
        //         foreach($MinApf as $MinApfs )
        //         {
        //             $MinApf = $MinApfs->total_Apf;
        //         }
        //         // มากสุด - น้อยสุด เพื่อหาพลังงานทั้งหมด
        //         $Totalenergyyesterday[] = $MaxApf - $MinApf;


        // }

        // return Response::json([
        //     'Name' => $Name,
        //     'Totalenergythisday' => $Totalenergythisday,
        //     'Totalenergyyesterday' => $Totalenergyyesterday,
        // ], 200, [], JSON_NUMERIC_CHECK);

          // // $DisplayInfo = DB::table('dispaly_info')
    //     $Buildlist = DB::table('building')
    //     ->where('C_ID','=',Auth::user()->C_ID)
    //     ->select('id','Build_Name')
    //     ->get();

    //     foreach($Buildlist as $Buildlists)
    //     {
    //         $ID = $Buildlists->id;
    //         $Name[] = $Buildlists->Build_Name;

    //         $DisplayInfo[] = DB::table('display_info')
    //         ->where('C_ID','=',Auth::user()->C_ID)
    //         ->where('B_ID','=',$ID)
    //         ->get();
    //     }
    //    return($DisplayInfo);
            // $currentYear = Date("Y");
            // $currentMonth = Date("m");
            // $Day = DB::table('ems_overview')
            //     ->select(DB::Raw('DATE(Dis_date) as day'))
            //     ->where('C_ID','=',Auth::user()->C_ID)
            //     ->whereYear('Dis_date', '=', $currentYear)
            //     ->whereMonth('Dis_date','=',$currentMonth)
            //     ->GroupBy('day')
            //     ->get();
            // foreach($Day as $Days )
            //     {
            //         $Dayout = $Days->day;
                   
            //         $DateGraph = Date("d", strtotime($Dayout)- 86400);
                    
            //          //         $YesterdayDate = Date("Y-m-d", time() - 86400);
                    
            //         $Datetime = DB::table('ems_overview')
            //                 ->where('C_ID','=',Auth::user()->C_ID)
            //                 ->whereDate('Dis_date','=',$Dayout)
            //                 ->select(DB::Raw('MAX(Dis_date) as Maxdatetime, MIN(Dis_date) as Mindatetime'))
            //                 ->get();
            //         foreach($Datetime as $Datetimes)
            //         {
            //             $Maxdisdate = $Datetimes->Maxdatetime;
            //             $Mindisdate = $Datetimes->Mindatetime;
            //         }

            //         $Maxenergyeachday = DB::table('ems_overview')

            //                 ->where('C_ID','=',Auth::user()->C_ID)
            //                 ->where('Dis_date','=',$Maxdisdate) 
            //                 // ->orWhere('Dis_date','=', $Mindisdate)
            //                 ->select(DB::raw('SUM(Apf) as Maxapf'))
            //                 ->GroupBy('Dis_date')
            //                 ->get();
            //         foreach($Maxenergyeachday as $Maxenergyeachdays)
            //                 {
            //                     $Maxenergyeachday = $Maxenergyeachdays->Maxapf;
            //                 }
                    
            //         $Minenergyeachday = DB::table('ems_overview')

            //                 ->where('C_ID','=',Auth::user()->C_ID)
            //                 // ->where('Dis_date','=',$Maxdisdate) 
            //                 ->Where('Dis_date','=', $Mindisdate)
            //                 ->select(DB::raw('SUM(Apf) as Minapf'))
            //                 ->GroupBy('Dis_date')
            //                 ->get();
                    
            //         foreach($Minenergyeachday as $Minenergyeachdays)
            //             {
            //                 $Minenergyeachday = $Minenergyeachdays->Minapf;
            //             }

            //         $Totalenergyeachday = $Maxenergyeachday - $Minenergyeachday;

            //         $result[] = array($DateGraph,$Totalenergyeachday);

            //     }

            // return $result;
            
            

        //     $Date = Input::get('Date');
        // $currentYear = Date("Y", strtotime($Date));
        // // $currentMonth = Date("m", strtotime($Date));
        // $Month = DB::table('ems_overview')
        //     ->select(DB::Raw('MONTH(Dis_date) as month'))
        //     ->where('C_ID','=',Auth::user()->C_ID)
        //     ->whereYear('Dis_date', '=', $currentYear)
        //     // ->whereMonth('Dis_date','=',$currentMonth)
        //     ->GroupBy('month')
        //     ->get();
        // foreach($Month as $Months )
        //     {
        //         $Monthout = $Months->month;
               
        //         // $DateGraph = Date("d", strtotime($Dayout));
        //         // $DateGraph = Date("d", strtotime($Dayout)- 86400);
        //         $MonthGraph = $Monthout-1;

                
        //         $Datetime = DB::table('ems_overview')
        //                 ->where('C_ID','=',Auth::user()->C_ID)
        //                 ->whereMonth('Dis_date','=',$Monthout)
        //                 ->select(DB::Raw('MAX(Dis_date) as Maxdatetime, MIN(Dis_date) as Mindatetime'))
        //                 ->get();
        //         foreach($Datetime as $Datetimes)
        //         {
        //             $Maxdisdate = $Datetimes->Maxdatetime;
        //             $Mindisdate = $Datetimes->Mindatetime;
        //         }

        //         $Maxenergyeachmonth = DB::table('ems_overview')

        //                 ->where('C_ID','=',Auth::user()->C_ID)
        //                 ->where('Dis_date','=',$Maxdisdate) 
        //                 // ->orWhere('Dis_date','=', $Mindisdate)
        //                 ->select(DB::raw('SUM(Apf) as Maxapf'))
        //                 ->GroupBy('Dis_date')
        //                 ->get();
        //         foreach($Maxenergyeachmonth as $Maxenergyeachmonths)
        //                 {
        //                     $Maxenergyeachmonth = $Maxenergyeachmonths->Maxapf;
        //                 }
                
        //         $Minenergyeachmonth = DB::table('ems_overview')

        //                 ->where('C_ID','=',Auth::user()->C_ID)
        //                 // ->where('Dis_date','=',$Maxdisdate) 
        //                 ->Where('Dis_date','=', $Mindisdate)
        //                 ->select(DB::raw('SUM(Apf) as Minapf'))
        //                 ->GroupBy('Dis_date')
        //                 ->get();
                
        //         foreach($Minenergyeachmonth as $Minenergyeachmonths)
        //             {
        //                 $Minenergyeachmonth = $Minenergyeachmonths->Minapf;
        //             }

        //         $Totalenergyeachmonth = $Maxenergyeachmonth - $Minenergyeachmonth;

        //         $result[] = array($MonthGraph,$Totalenergyeachmonth);

        //     }
        //     return $result;

    //     header("Content-type: text/json");

    //     $Startdate = "2018-11-22";
    //     $Stopdate = "2018-11-23";

    //     $RealtimepowerDaily = DB::table('ems_overview')
    //     ->where('C_ID','=',Auth::user()->C_ID)
    //     ->whereDate('Dis_date', '<=', $Stopdate)
    //     ->whereDate('Dis_date', '>=', $Startdate)
    //     ->SelectRaw('(UNIX_TIMESTAMP(Dis_Date))*1000 AS x , SUM(Pof) as y')
    //     ->groupBy('Dis_Date')
    //     ->get();
    // return Response::json($RealtimepowerDaily, 200, [], JSON_NUMERIC_CHECK); 

        //     $datestart = '2018-11-22';
        //     $datestop = '2018-11-30';
        //     $Start = Date("Y-m-d", strtotime($datestart));
        //     $Stop = Date("Y-m-d", strtotime($datestop));

        //     for($st = $Start ; $st <= $Stop ; $st = Date("Y-m-d", strtotime($st)+ 86400) )
        //     {
        //         $ar = $st;
        //         $resultplot[] = array($ar,null);
        //     }
           
        //   dump($resultplot);

        $Building = DB::table('building')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->get();

        $Department = DB::table('department')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->get();
        
        return $Department;

    }
}


