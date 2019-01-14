<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Display_list extends Model
{
    protected $table = 'display_lists';
    protected $fillable = ['id','SerialNo','Dis_Number','C_ID'];
}
