<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Hisab;

use App\Customer;
use App\Product;

class HisabsController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $customer = Customer::find($id);
        // $hisabs = Hisab::all()->where('party_id',$customer->id);
        // return view('hisabs.view',compact('hisabs','customer'));

        $hisabs = Hisab::all()->where('status','ongoing');

        foreach($hisabs as $hisab){
            if($hisab->status == "ongoing"){
                $hisab->credit = 0;
                $hisab->debit = 0;
                foreach($hisab->orders as $order) {
                    $hisab->credit += $order->amount;
                }
                foreach($hisab->payments as $payment) {
                    $hisab->debit += $payment->debit;
                }
                $hisab->save();
            }
        }

        return view('hisabs.index',compact('hisabs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customers = Customer::all();
        return view('hisabs.create',compact('customers'));
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
        // $post = Request->all();

         $this->validate($request, [
            'customer_id' => 'required'
        ]);

        $hisab = new Hisab;
        $hisab->party_id = $request->customer_id;
        // $hisab_status = $request->hisab_status;
        $hisab_status = "ongoing";
        $hisab->save();
        return redirect('hisab/'.$hisab->id);
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
        $hisab = Hisab::find($id);
        $products = Product::all();
        if($hisab->status == "ongoing"){
            $hisab->credit = 0;
            $hisab->debit = 0;
            foreach($hisab->orders as $order) {
                $hisab->credit += $order->amount;
            }
            foreach($hisab->payments as $payment) {
                $hisab->debit += $payment->debit;
            }
            $hisab->save();
        }

        return view('hisabs.show',compact('hisab','products'));
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
    public function update(Request $request, $id)
    {
        //
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
