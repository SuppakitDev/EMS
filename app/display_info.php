<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class display_info extends Model
{
    protected $table = 'display_info';
    protected $fillable = ['id','Dis_SerialNo','C_ID','B_ID','Dis_Number','DisModel'
                            ,'DisManufacturing_Date','DisFirmware_Version','Ct_SerialNo','CtModel'
                            ,'CtManufacturing_Date','CtFirmware_Version','created_at','updated_at'];

    // public function ct_infos()
    // {
    //     return $this->belongsTo('App\ct_info');
    // }

    public function client_companys()
    {
        return $this->belongsTo('App\client_company','C_ID');
    }

    public function buildings()
    {
        return $this->belongsTo('App\building','B_ID');
    }

}
