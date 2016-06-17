<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Customer;
use App\Payment;
use App\Hisab;

class PaymentsReceivableController extends Controller
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
        $customers = Customer::all();
        $payments = Payment::all()->where('type', 'receivable');

        // return view('payments.index',compact('customers','payements'));
        return view('payments.receivable.index', compact('customers','payments'));

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

        return view('payments.receivable.create',compact('customers'));
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

         $this->validate($request, [
            'customer_id' => 'required',
            'date' => 'required',
            'amount' => 'required'
        ]);

        $payment = new Payment;
        $payment->party_id = $request->customer_id;
        $payment->date = $request->date;
        $payment->debit = $request->amount; // Debit Cash Payments | Payment Received
        $payment->type = "receivable";

        $hisab = Hisab::where('party_id','=',$request->customer_id)->where('status','=','ongoing')->first();
        
        if($hisab == Null){
          $hisab = new Hisab;
          $hisab->party_id = $request->customer_id;
          $hisab->status = "ongoing";
          $hisab->save();
          $payment->hisab_id = $hisab->id;
        }
        else $payment->hisab_id = $hisab->id;  

        $payment->save();

        return redirect('payments/receivable');
        
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
