<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeContentController extends Controller
{
    public function getEmsOverviewDaily()
    {
        $view = view("Content/Manager/EmsOverviewDaily")->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsOverviewMonthly()
    {
        $view = view("Content/Manager/EmsOverviewMonthly")->render();
        return response()->json(['html'=>$view]);
    }
    public function getEmsOverviewYearly()
    {
        $view = view("Content/Manager/EmsOverviewYearly")->render();
        return response()->json(['html'=>$view]);
    }
}
