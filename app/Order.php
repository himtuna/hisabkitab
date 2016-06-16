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
   	 
    public function hisab()
    {
        // working
        // return $this->belongsTo(Hisab::class);
        return $this->belongsTo('App\Hisab','id');

    }   

    public function productstotal()
    {   
        $total = array(0 =>0, 1=>0,2=>0,3=>0,4=>0);
        // $count($this->orderlines);
        foreach($this->orderlines as $orderline){
            $total[$orderline->product_id]+=$orderline->units;            
        }
        // var_dump($total);exit();
        return $total;

    }   
    
}
