<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmsInformationController extends Controller
{
    public function index()
    {
        return view("Content.Manager.Information");
    }
}
