<?php

namespace App\Http\Controllers;
use PDF;
use DateTime;
use DB;
use Auth;
use App\client_company;
use Alert;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ElectricityChargeController extends Controller
{
    public function ElectricityChargeBill_Preview()
    {
        $Building = DB::table('building')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->Select('Build_Name')
        ->get();


        $Company = DB::table('client_company')
        ->where('id','=',Auth::user()->C_ID)
        ->select('C_Name','Money_rate','Tel','Address','Email')
        ->get();
        foreach($Company as $Companys )
        {
            $Money_rate = $Companys->Money_rate;
            $C_Name = $Companys->C_Name;
            $Tel = $Companys->Tel;
            $Address = $Companys->Address;
            $Email = $Companys->Email;
        }

        $Account = DB::table('users')
            ->where('id','=',Auth::user()->id)
            ->select('Fname')
            ->get();
            foreach($Account as $Accounts)
            {
                    $AccountName = $Accounts->Fname;
            }

        $DeptID = Input::get('ElectricDepartment');
        $Month = Input::get('ElectricMonthSelect');
        $Monthshow = Date("Y-M", strtotime($Month));
        $M = Date("m", strtotime($Month));
        $Y = Date("Y", strtotime($Month));

        $Department = DB::table('department')
        ->whereIn('id',$DeptID)
        ->Select('id','Dept_Name')
        ->get(); 

        foreach($Department as $Departments)
        {
            $Disdate = DB::table('ems_overview')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=',$Departments->id)
            ->whereMonth('Dis_date','=',$M)
            ->whereYear('Dis_date','=',$Y)
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
                    ->where('D_ID','=',$Departments->id)
                    ->where('Dis_date' ,'=',$MAXDISDATE)
                    ->Select(DB::raw('SUM(Apf) as total_Apf'))
                    ->groupBy('Dis_Date')
                    ->get();
                    // ดึง Apf รวมของเวลาที่น้อยสุด
                    $MinApf = DB::table('ems_overview')
                    ->where('C_ID','=',Auth::user()->C_ID)
                    ->where('D_ID','=',$Departments->id)
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
                    $Totalenergythisday[] = number_format(($MaxApf - $MinApf),2);
                    $Charge[] = number_format((($MaxApf - $MinApf)*$Money_rate),2);
                    $Chargebuf[] = ($MaxApf - $MinApf)*$Money_rate;
                    $DeptName[] = $Departments->Dept_Name;

                    $SumEnergy = number_format(array_sum($Totalenergythisday),2);
                    $SumCharge = number_format(array_sum($Chargebuf),2);
        }
       
        $DepartmentID =  implode(" ",$DeptID);
        // return $DepartmentID;

        return view('PDFExport.ElectricityChargePreview',[
            'Totalenergythisday' => $Totalenergythisday,
            'Charge' => $Charge,
            'DeptName' => $DeptName,
            'SumEnergy' => $SumEnergy,
            'SumCharge' => $SumCharge,
            'Account' => $AccountName,
            'Money_rate' => $Money_rate,
            'C_Name' => $C_Name,
            'Tel' => $Tel,
            'Building' => $Building,
            'Monthshow' => $Monthshow,
            'Address' => $Address,
            'Email' => $Email,
            'DeptID' => $DepartmentID,
            'Month' => $Month,
        ]);
    }

    public function ElectricityChargeBill_Export()
    {

        $Building = DB::table('building')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->Select('Build_Name')
        ->get();


        $Company = DB::table('client_company')
        ->where('id','=',Auth::user()->C_ID)
        ->select('C_Name','Money_rate','Tel','Address','Email')
        ->get();
        foreach($Company as $Companys )
        {
            $Money_rate = $Companys->Money_rate;
            $C_Name = $Companys->C_Name;
            $Tel = $Companys->Tel;
            $Address = $Companys->Address;
            $Email = $Companys->Email;
        }

        $Account = DB::table('users')
            ->where('id','=',Auth::user()->id)
            ->select('Fname')
            ->get();
            foreach($Account as $Accounts)
            {
                    $AccountName = $Accounts->Fname;
            }

        $DeptID = Input::get('ElectricDepartment');

        $DeptID = explode(" ",$DeptID);
        $Month = Input::get('ElectricMonthSelect');
        $Monthshow = Date("Y-M", strtotime($Month));
        $M = Date("m", strtotime($Month));
        $Y = Date("Y", strtotime($Month));

        $Department = DB::table('department')
        ->whereIn('id',$DeptID)
        ->Select('id','Dept_Name')
        ->get(); 

        foreach($Department as $Departments)
        {
            $Disdate = DB::table('ems_overview')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('D_ID','=',$Departments->id)
            ->whereMonth('Dis_date','=',$M)
            ->whereYear('Dis_date','=',$Y)
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
                    ->where('D_ID','=',$Departments->id)
                    ->where('Dis_date' ,'=',$MAXDISDATE)
                    ->Select(DB::raw('SUM(Apf) as total_Apf'))
                    ->groupBy('Dis_Date')
                    ->get();
                    // ดึง Apf รวมของเวลาที่น้อยสุด
                    $MinApf = DB::table('ems_overview')
                    ->where('C_ID','=',Auth::user()->C_ID)
                    ->where('D_ID','=',$Departments->id)
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
                    $Totalenergythisday[] = number_format(($MaxApf - $MinApf),2);
                    $Charge[] = number_format((($MaxApf - $MinApf)*$Money_rate),2);
                    $Chargebuf[] = ($MaxApf - $MinApf)*$Money_rate;
                    $DeptName[] = $Departments->Dept_Name;

                    $SumEnergy = number_format(array_sum($Totalenergythisday),2);
                    $SumCharge = number_format(array_sum($Chargebuf),2);
        }

        $pdf = PDF::loadView('PDFExport.ElectricityCharge',[
                    'Totalenergythisday' => $Totalenergythisday,
                    'Charge' => $Charge,
                    'DeptName' => $DeptName,
                    'SumEnergy' => $SumEnergy,
                    'SumCharge' => $SumCharge,
                    'Account' => $AccountName,
                    'Money_rate' => $Money_rate,
                    'C_Name' => $C_Name,
                    'Tel' => $Tel,
                    'Building' => $Building,
                    'Monthshow' => $Monthshow,
                    'Address' => $Address,
                    'Email' => $Email,
                    'DeptID' => $DeptID,
                    'Month' => $Month,
        ])->setPaper('a4', 'landscape')->setWarnings(false);
        return $pdf->download('ElectricityCharge.pdf');
    }

    public function Setnewmoneyrate()
    {
        $Moneyrate = Input::get('Moneyrate');
        
        $company = client_company::find(Auth::user()->C_ID);
        
        $company->Money_rate = $Moneyrate;
        $company->save();
        alert()->success('This MoneyRate Changed.', 'Success!');
        return redirect()->Back();
        
    }
}
