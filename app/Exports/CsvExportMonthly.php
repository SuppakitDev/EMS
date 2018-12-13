<?php

namespace App\Exports;

use App\ems_info;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CsvExportMonthly implements FromView
{
 
    private $data;
 
    public function __construct($data,$Month,$Deptname)
    {
        $this->data = $data;
        $this->month = $Month;
        $this->deptname = $Deptname;
    }
    public function view(): View
    {
        return view('Export.CsvExportMonthly',[
            'data' => $this->data,
            'month' => $this->month,
            'deptname' => $this->deptname,
        ]);
    }
}
