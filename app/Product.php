<?php

namespace App;
use DB;
use App\Price;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function price(Customer $customer)
    {   
        $price = Price::where('isdefault',1)->where('customer_id',$customer->id)->where('product_id',$this->id)->first();
				
        return $price["unit_price"];
    }
}