<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Customer;
use App\Order;
use App\Orderline;
use App\Product;
use DB;

class CustomersController extends Controller
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
        return view('customers.index', compact('customers'));
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
        $customer = new Customer;

        $this->validate($request, [
            'customer_name' => 'required'
        ]);

        $customer->name = $request->customer_name;
        $customer->phone = $request->phone;

        $customer->save();

        return back();

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
        $customer = Customer::find($id);

        return view('customers.edit', compact('customer'));
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
        $customer = Customer::find($id);
        $customer->name = $request['customer_name'];
        $customer->phone = $request['phone'];
        $customer->update();

        return redirect('/customers');
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

    public function orders(Customer $customer)
    {   
        $orders = Order::all()->where('customer_id',$customer->id);
        $products = Product::all();
        // var_dump($orders); exit();
        // $orders = DB::table

        // $ordersbyProducts = DB::table('orders')->join('orderlines','orders.id','=','orderlines.id')->select('orders.id','orderlines.product_id', 
        //     DB::raw('SUM(orderlines.units) as units'))->where('orders.id', 'orderlines.order_id')->groupBy('orders.id','orderlines.product_id')->get();

        // var_dump(DB::table('orders')->join('orderlines','orders.id','=','orderlines.id')->select('orders.id','orderlines.product_id', DB::raw('SUM(orderlines.units) as units'))->groupBy('orderlines.product_id','orders.id')->where('customer_id',$customer->id)->get()); exit();

        // $odersbyProducts = array();
        $ordersbyProducts = DB::select(DB::raw('SELECT orders.id,orderlines.product_id, SUM(orderlines.units) as units from orders,orderlines 
                where orders.id=orderlines.order_id AND orders.customer_id ='.$customer->id.' GROUP by orders.id, orderlines.product_id')
            );

        // var_dump($ordersbyProducts[1]); exit();

        // var_dump($orders); exit();            
    
        // $orderlines = Orderline::all()->where()
        // $orders = DB::table('orders')->join('orderlines','orders.id','=','orderlines.order_id')->where('customer_id',$customer->id)->get();

        // $orders = Order::all()->Join('Orderlines','Orderlines.ID','=','Order.id')->groupby('Orderlines.product_id')->where('customer_id',$customer->id);

        // var_dump($orders); exit();
        // echo count($orders); exit();
        return view('customers.orders', compact('orders','products','customer','ordersbyProducts'));
    }

    public function orderstotal()
    {
        $products = Product::all();
        $customers = Customer::all();

        $orderstotalbyCustomers = DB::select(DB::raw('SELECT orders.customer_id,orderlines.product_id, SUM(orderlines.units) as units from orders,orderlines where orders.id=orderlines.order_id and orders.order_status="confirmed" GROUP by orders.customer_id, orderlines.product_id')
        );

        $countordersbyCustomers = DB::select(DB::raw('select orders.customer_id, count(orders.id) as total_orders from orders where orders.order_status="confirmed" group by orders.customer_id'));
        // var_dump($orderstotalbyCustomers);exit();
    
        return view('customers.orderstotal', compact('orders','products','customers','orderstotalbyCustomers','countordersbyCustomers'));
        
    }
    
}