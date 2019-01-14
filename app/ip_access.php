<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ip_access extends Model
{
    protected $table = 'ip_access';
    protected $fillable = ['id','DIS_number','IP_Access'];
}
