<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Customer;

use App\Product;

use App\Price;

class CustomerPricesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer)
    {
        //
        $products = Product::all();
        $prices = Price::all()->where('customer_id',$customer->id);
        return view('prices.show-customerwise',compact('prices','products','customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customer)
    {
        //
        // var_dump($request); exit();
        $products = Product::all();
        $customer = Customer::find($customer);
        $post = $request->all();
        $prices = Price::all()->where('customer_id',$customer->id);
        
        foreach ($products as $product) {
            
            if(($post['product-'.$product->id] == NULL) && (NULL !== $product->price($customer))) {
                // Delete the customer price because blank input received and the record already exists
                 $price=Price::all()->where('customer_id',$customer->id)->where('product_id',$product->id)->where('isdefault',1)->first();
                 $price->isdefault = 0;
                 $price->update();
            }
            elseif($post['product-'.$product->id] != NULL) {

                if((NULL == $product->price($customer)) && ($post['product-'.$product->id] != $product->unit_price )){
                //create a new price if price doesn't exist and the user input differs from default price, and user input is not empty
                    $price = new Price;
                    $price->customer_id = $customer->id;
                    $price->product_id = $product->id;
                    $price->unit_price = $post['product-'.$product->id];
                    $price->isdefault = 1; //get rid of this
                    $price->save();              
                }

                elseif(NULL !== $product->price($customer)){
                    //the price exists
                    if($post['product-'.$product->id] != $product->unit_price) {
                        //price exists but user input differs from default price and is not blank and should update price
                        $price=Price::all()->where('customer_id',$customer->id)->where('product_id',$product->id)->where('isdefault',1)->first();
                        $price->unit_price = $post['product-'.$product->id];
                        $price->update();
                    }                
                    else {
                        //price exists but user input differs is equal to default price and should be deleted
                        $price=Price::all()->where('customer_id',$customer->id)->where('product_id',$product->id)->where('isdefault',1)->first();
                        $price->isdefault = 0;
                        $price->update();
                    }
                }
                
                //if price doesn't exist and user input is empty do nothing: default
            }
            
            
        }
        
        // exit();
        
        return redirect()->back();        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
