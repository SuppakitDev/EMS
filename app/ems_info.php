<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ems_info extends Model
{
    protected $table = 'ems_info';
    protected $fillable = [
            'id','C_ID','B_ID','D_ID','Dis_Number','Dis_Date',
            'ID1','Ln1','Cs1','Ec1','Fm1','Vrms1','Irms1','S1','Q1','PF1','Apf1','Apr1','Pof1','Por1',
            'ID2','Ln2','Cs2','Ec2','Fm2','Vrms2','Irms2','S2','Q2','PF2','Apf2','Apr2','Pof2','Por2',
            'ID3','Ln3','Cs3','Ec3','Fm3','Vrms3','Irms3','S3','Q3','PF3','Apf3','Apr3','Pof3','Por3',
            'ID4','Ln4','Cs4','Ec4','Fm4','Vrms4','Irms4','S4','Q4','PF4','Apf4','Apr4','Pof4','Por4',
            'ID5','Ln5','Cs5','Ec5','Fm5','Vrms5','Irms5','S5','Q5','PF5','Apf5','Apr5','Pof5','Por5',
    ];

    public function client_companys()
    {
        return $this->belongsTo('App\client_company','C_ID');
    }

    public function buildings()
    {
        return $this->belongsTo('App\building','B_ID');
    }

    public function departments()
    {
        return $this->belongsTo('App\department','D_ID');
    }

}
