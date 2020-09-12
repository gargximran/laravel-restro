<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $primaryKey = 'order_id';
    public $incrementing = false;

    public function bill(){
        return $this->belongsTo(bill::class, 'bill_id', 'bill_id');
    }
}
