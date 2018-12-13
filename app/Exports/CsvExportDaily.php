<?php

namespace App\Exports;

use App\ems_info;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CsvExportDaily implements FromView
{
    private $data;
 
    public function __construct($data,$Date,$Deptname)
    {
        $this->data = $data;
        $this->date = $Date;
        $this->deptname = $Deptname;
    }
    public function view(): View
    {
        return view('Export.CsvExportDaily',[
            'data' => $this->data,
            'date' => $this->date,
            'deptname' => $this->deptname,
        ]);
    }
}
