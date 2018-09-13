<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
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
}
