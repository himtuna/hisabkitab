<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hisab extends Model
{
    //
    public function customer()
    {
        // return $this->belongsTo(Customer::class);
        return $this->belongsTo('App\Customer','party_id','id');
    }

    public function payments()
	{
		// return $this->hasMany(Hisab::class);
		return $this->hasMany(Payment::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
		// return $this->hasMany('App\Order','id');
	}
}
