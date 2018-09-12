<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client_company extends Model
{
    protected $table = 'client_company';
    protected $fillable = ['id','C_name','Display_list','Tel','Money_rate'];

    public function Users()
    {
        return $this->hasMany('App\User','C_ID');
    }

    public function buildings()
    {
        return $this->hasMany('App\building','C_ID');
    }

    public function ems_overviews()
    {
        return $this->hasMany('App\ems_overview','C_ID');
    }

    public function ems_infos()
    {
        return $this->hasMany('App\ems_info','C_ID');
    }

    public function display_infos()
    {
        return $this->hasMany('App\display_info','C_ID');
    }

}
