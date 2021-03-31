<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id','department_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    public function roles()
    {
      return   $this->belongsToMany('App\Role','user_role','user_id','role_id');
    }


    public function hasRole($slug){
        if($this->roles()->where('slug',$slug)->first()){

        return true;
        }
        return false;
    }




    public function leaves()
    {
       return $this->hasMany(Leave::class)->orderBy('id', 'desc')->paginate(50);
    }


    public function departments()
    {
       return $this->belongsTo(Department::class,'department_id');
    }
    

}
