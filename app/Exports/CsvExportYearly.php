<?php

namespace App\Exports;

use App\ems_info;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CsvExportYearly implements FromView
{
   
    private $data;
 
    public function __construct($data,$Year,$Deptname)
    {
        $this->data = $data;
        $this->year = $Year;
        $this->deptname = $Deptname;
    }
    public function view(): View
    {
        return view('Export.CsvExportYearly',[
            'data' => $this->data,
            'year' => $this->year,
            'deptname' => $this->deptname,
        ]);
    }
}
