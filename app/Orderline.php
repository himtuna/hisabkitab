<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    //
    public function order()
    {
    	return $this->belongsTo(Order::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class)->groupby('id');
    }

    public function colour()
    {
    	return $this->belongsTo(Colour::class);
    }
   

}
