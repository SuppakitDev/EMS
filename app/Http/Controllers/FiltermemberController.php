<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Yajra\DataTables\Facades\Datatables;
use App\client_company;
class FiltermemberController extends Controller
{
    public function Index()
    {
        if(Auth::user()->Status == "ADMIN")
        {
            return view('Content\Admin\Adminhome');
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

    public function getcompany()
    {
            return Datatables::eloquent(client_company::query())->make(true);
    }
}
