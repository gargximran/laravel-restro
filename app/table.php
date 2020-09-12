<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function bill(){
        return $this->hasMany(Bill::class, 'table_id', 'table_id');
    }
}
