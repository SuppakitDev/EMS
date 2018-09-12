<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ct_info extends Model
{
    protected $table = 'ct_info';
    protected $fillable = ['id','Dis_SerialNo','Ct_SerialNo','Model','Manufacturing_Date','Firmware_Version'];

    public function display_infos()
    {
        return $this->hasOne('App\display_info','id','id');
    }

}
