<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ems_overview extends Model
{
    protected $table = 'ems_overview';
    protected $fillable = ['id','C_ID','B_ID','D_ID','Dis_Number','Dis_Date','Vrms','Irms','S','Q','PF','Apf','Apr','Pof','Por'];

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
