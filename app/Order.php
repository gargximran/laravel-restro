<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function bill(){
        return $this->belongsTo(bill::class, 'bill_id', 'bill_id');
    }
}
