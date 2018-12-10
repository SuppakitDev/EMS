<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DB;
use Auth;
use App\ems_overview;
use App\User;
use App\client_company;
use App\display_info;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class EmsInformationController extends Controller
{
    public function index()
    {
        $Department = DB::table('department')
                    ->where('C_ID','=',Auth::user()->C_ID)
                    ->get();
        $Building = DB::table('building')
                    ->where('C_ID','=',Auth::user()->C_ID)
                    ->get();

        $Buildlist = DB::table('building')
        ->where('C_ID','=',Auth::user()->C_ID)
        ->select('id','Build_Name')
        ->get();

        foreach($Buildlist as $Buildlists)
        {
            $ID = $Buildlists->id;
            $Name[] = $Buildlists->Build_Name;

            $DisplayInfo[] = DB::table('display_info')
            ->where('C_ID','=',Auth::user()->C_ID)
            ->where('B_ID','=',$ID)
            ->get();
        }
       
        return view("Content.Manager.Information",[
            'DisplayInfo' => $DisplayInfo,
            'Name' => $Name,
            'Building' => $Building,
            'Department' => $Department,
        ]);
    }
}
