<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','Username','Fname','Lname','Tel','image','CreateBy','C_ID','B_ID','D_ID','email','Status','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
