<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class building extends Model
{
    protected $table = 'building';
    protected $fillable = ['id','C_ID','Build_Name','Display_list'];

    public function Users()
    {
        return $this->hasMany('App\User','B_ID');
    }

    public function client_companys()
    {
        return $this->belongsTo('App\client_company','C_ID');
    }

    public function display_infos()
    {
        return $this->hasMany('App\display_info','B_ID');
    }

    public function departments()
    {
        return $this->hasMany('App\department','B_ID');
    }

    public function ems_overviews()
    {
        return $this->hasMany('App\ems_overview','B_ID');
    }

    public function ems_infos()
    {
        return $this->hasMany('App\ems_info','B_ID');
    }

}
