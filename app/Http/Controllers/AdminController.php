<?php

namespace App\Http\Controllers;
use App\client_company;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{

    public function admintheme()
    {
        $Admintheme = DB::table('users')
        ->where('Status','=', 'ADMIN')
        ->get();
        return view('Content/Admin/Admintheme',
        [
            'admintheme' => $Admintheme,
        ]);
    }

    public function company()
    {
        $company = DB::table('client_company')->get();
        return view('Content\Admin\Companylist',
        [
            'company' => $company,
        ]);
    }

    public function database()
    {
        return view('Content/Admin/Database');
    }

    public function calendar()
    {
        return view('Content/Admin/Calendar');
    }

    public function PointmapAPI()
    {
        header("Content-type: text/json");
        $data = DB::table('client_company')
        ->select('C_name as name','lat','lon')
        ->where('id' , '!=', 0)
        ->get();
        // $company = DB::table('Mapspoint')->get();
        // $myArray = [['name'=>'Chachoengsao', 'lat'=>13.687460 , 'lon'=>101.070663]];
        return Response::json($data, 200, [], JSON_NUMERIC_CHECK);
    }

}
