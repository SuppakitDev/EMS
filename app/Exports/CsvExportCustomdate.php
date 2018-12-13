<?php

namespace App\Exports;

use App\ems_info;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CsvExportCustomdate implements FromView
{
    private $data;
 
    public function __construct($data,$Start,$Stop,$Deptname)
    {
        $this->data = $data;
        $this->startdate = $Start;
        $this->stopdate = $Stop;
        $this->deptname = $Deptname;
    }
    public function view(): View
    {
        return view('Export.CsvExportCustomdate',[
            'data' => $this->data,
            'startdate' => $this->startdate,
            'stopdate' => $this->stopdate,
            'deptname' => $this->deptname,
        ]);
    }
}
