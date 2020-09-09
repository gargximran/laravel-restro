<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    public function user(){
        return $this->hasMany(User::class, 'admin_id', 'user_id');
    }


    public function admin(){
        return $this->belongsTo(User::class, "admin_id", 'user_id');
    }

    public function table(){
        return $this->hasMany(table::class, 'user_id', "user_id");
    }


    public function tables(){
        return $this->hasMany(table::class, 'user_id', "user_id");
    }



    public function categories(){
        return $this->hasMany(Category::class, "user_id", "user_id");
    }


    public function food(){
        return $this->hasMany(Food::class, 'user_id', 'user_id');
    }
}
