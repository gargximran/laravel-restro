<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }



    public function foods(){
        return $this->hasMany(Food::class, 'category_id', "cat_id");
    }
}
