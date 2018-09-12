<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $table = 'department';
    protected $fillable = ['id','B_ID','Dept_Name'];

    public function Users()
    {
        return $this->hasMany('App\User','D_ID');
    }

    public function buildings()
    {
        return $this->belongsTo('App\building','B_ID');
    }

    public function ems_infos()
    {
        return $this->hasMany('App\ems_infos','D_ID');
    }

    public function ems_overviews()
    {
        return $this->hasMany('App\ems_overview','D_ID');
    }

}
