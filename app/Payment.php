<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    public function hisab()
    {
        return $this->belongsTo(Hisab::class);
        // return $this->belongsTo('App\Hisab','id');
    }

   	public function customer()
    {
        // return $this->belongsTo(Customer::class);
        return $this->belongsTo('App\Customer','party_id','id');
    }
}
