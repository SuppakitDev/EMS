<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

use App\client_company;
use DB;
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
            return view('Content\Manager\Managerhome');
        }
        elseif(Auth::user()->Status == "USER")
        {
            return view('Content\User\Userhome');
        }
    }
}
