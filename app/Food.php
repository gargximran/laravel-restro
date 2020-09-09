<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public function category(){
        return $this->belongsTo(Category::class, "category_id", "cat_id");
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
