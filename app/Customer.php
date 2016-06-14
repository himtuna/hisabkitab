<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function orders()
	{
		return $this->hasMany(Order::class);
	}

/*	public function prices()
	{
		return $this->hasMany(Price::class);
	}	*/
}
