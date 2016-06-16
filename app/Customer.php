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
/*	public function prices()
	{
		return $this->hasMany(Price::class);
	}	*/
}
