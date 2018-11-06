<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsidedeptController extends Controller
{
    public function index()
    {
        return view("Content/Manager/InsideDept");
    }

    public function getEmsInsideDeptDaily()
    {
        $view = view("Content/Manager/EmsInsideDeptDaily")->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsInsideDeptMonthly()
    {
        $view = view("Content/Manager/EmsInsideDeptMonthly")->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsInsideDeptYearly()
    {
        $view = view("Content/Manager/EmsInsideDeptYearly")->render();
        return response()->json(['html'=>$view]);
    }
}
