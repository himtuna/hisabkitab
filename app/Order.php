<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = [
        'order_status'
    ];

    public function orderlines()
	{
		return $this->hasMany(Orderline::class);
	}


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
   	    
    
}
