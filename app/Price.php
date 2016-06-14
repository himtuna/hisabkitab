<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    // 
    public function product()
    {
    	return $this->belongsTo(Product::class)->groupby('id');
    }


    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}
