<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function hisabs()
	{
		// return $this->hasMany(Hisab::class);
		return $this->hasMany('App\Hisab','id','party_id');
	}
	// public function prices()
	// {
	// 	return $this->hasMany(Price::class);
	// }	
	public function prices(Customer $customer)
    {   

        $unit_prices = Price::all()->where('isdefault',1)->where('customer_id',$customer->id);
        return $this->unit_prices;
    }
}
