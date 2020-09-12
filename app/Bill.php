<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $primaryKey = 'bill_id';
    public $incrementing = false;

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function order(){
        return $this->hasMany(Order::class, 'bill_id', 'bill_id');
    }
}
