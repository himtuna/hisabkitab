<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Order;

use App\Orderline;

use App\Hisab;

use App\Product;

use App\Customer;

use DB;

class OrdersController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
   
   // index of all orders 
   public function index(Request $request)
   {
      // $url = $request['url']; var_dump($url);exit();
    	$orders = Order::all()->where('order_status','draft');
    	return view('orders.index', compact('orders'));
   }
   
   // index of confirmed orders

     public function indexConfirmed()
   {
    	$orders = Order::all()->where('order_status','confirmed');
    	return view('orders.index', compact('orders'));
   }

    public function indexReceived()
    {
      $orders = Order::all()->where('invoice_received','Yes');
      return view('orders.index', compact('orders'));
    }
    
    public function indexLost()
    {
      $orders = Order::all()->where('invoice_received','Lost');
      return view('orders.index', compact('orders'));
    }


   public function add()
   {

   	$products = DB::table('products')->get();
   	$colours = DB::table('colours')->get();
   	$customers = DB::table('customers')->get();

   	 return view('orders.add')->with('products', $products)->with('customers',$customers)->with('colours',$colours);
   }


public function addinvoice()
   {

    $products = DB::table('products')->get();
    $colours = DB::table('colours')->get();
    $customers = DB::table('customers')->get();

     return view('orders.addinvoice')->with('products', $products)->with('customers',$customers)->with('colours',$colours);
   }

   public function storeorder(Request $request)
   {
   		$post = $request->all();
   		$this->validate($request, [
            'customer_id' => 'required',       

      ]);

      $products = Product::all();
      $customer = Customer::find($request->customer_id);
      $order = new Order;
   		$order->customer_id = $request->customer_id;

            
        if($request->order_created_on=="0000-00-00")
          $order->order_created_on = date('Y-m-d');
        else 
          $order->order_created_on = $request['order_created_on'];
        
        $order->invoice_received = "0000-00-00";
        $order->order_status = 'draft';    
   	    $order->amount =0;
      
   		$order->save();
 		
 		 // var_dump(count($post['orderline']));
      
   		for ($i=0; $i < count($post['product_id']); $i++) { 
        $product_price = 0;

   			$orderline = new Orderline;
   			$orderline->order_id = $order->id;
   			$orderline->product_id = $post['product_id'][$i];
   			
        if($post['colour_id'] === "")
          $orderline->colour_id = Null;
        else $orderline->colour_id = $post['colour_id'][$i];

        $orderline->units = $post['qty'][$i];

        $product_price = $products[$post['product_id'][$i]-1]->price($customer);
        if(NULL !== $products[$post['product_id'][$i]-1]->price($customer))
          $orderline->unit_price = $product_price;
        else
          $orderline->unit_price = $products[$post['product_id'][$i]-1]->unit_price;

        
   			
        $orderline->sub_amount = $orderline->units * $orderline->unit_price;
        $orderline->save();

        $order->amount +=$orderline->sub_amount;

        $order->save();
   		}

   		return redirect('order/'.$order->id);

   }

   public function storeinvoice(Request $request)
   {
      $post = $request->all();
      $this->validate($request, [
            'customer_id' => 'required',       

      ]);

      $products = Product::all();
      $customer = Customer::find($request->customer_id);
      $order = new Order;
      $order->customer_id = $request->customer_id;

      //ADDING INVOICE          
        if($request->invoice_date=="0000-00-00")
          $order->invoice_date = date('Y-m-d');   
        else 
          $order->invoice_date  = $request['order_created_on'];
        
        $order->order_created_on = $order->invoice_date;
        $order->order_status = 'confirmed';
        $order->invoice_received = $request->invoice_received;
      

      $hisab = Hisab::where('party_id','=',$order->customer_id)->where('status','=','ongoing')->first();
        
        if($hisab == Null){
          $hisab = new Hisab;
          $hisab->party_id = $request->customer_id;
          $hisab->status = "ongoing";
          $hisab->save();
          $order->hisab_id = $hisab->id;
        }
        else $order->hisab_id = $hisab->id;  

      $order->save();
    
     // var_dump(count($post['orderline']));

      for ($i=0; $i < count($post['product_id']); $i++) { 
        $orderline = new Orderline;
        $orderline->order_id = $order->id;
        $orderline->product_id = $post['product_id'][$i];
        
        if($post['colour_id'] === "")
          $orderline->colour_id = Null;
        else $orderline->colour_id = $post['colour_id'][$i];

        $orderline->units = $post['qty'][$i];
        
        
        $product_price = $products[$post['product_id'][$i]-1]->price($customer);
        if(NULL !== $products[$post['product_id'][$i]-1]->price($customer))
          $orderline->unit_price = $product_price;
        else
          $orderline->unit_price = $products[$post['product_id'][$i]-1]->unit_price;

        
        
        $orderline->sub_amount = $orderline->units * $orderline->unit_price;
        $orderline->save();

        $order->amount +=$orderline->sub_amount;

        $order->save();
      }

      return redirect('order/'.$order->id);

   }


   public function show($order)
   {
   		// $order->load('orderlines.customer');
   		$order = Order::find($order);
   		// var_dump($order); exit();
      return view('orders.show', compact('order'));
   		
   }

  
   
   	public function deleteOrder($order)
   	{
	   	$order = Order::find($order);
	   	// echo $order->orderlines; 
		// $order->orderlines[0]->delete();
	   	// $order->orderlines->all()->delete();
	   	foreach ($order->orderlines as $i => $ordeline) {
	   		$order->orderlines[$i]->delete();	   		
	   	}
		$order->delete();
		return redirect('orders/draft');
	} 

	 // note used
   public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }
    
    public function update(Request $request, $order)
    {  
      // var_dump($request['confirm_order']);exit();
      $order = Order::find($order);
      // var_dump($order);exit();
        // $post = $request->all();
        // var_dump($post);  exit();
        // var_dump($post['order_status']); exit();
        // $order->order_status = $post['order_status'];
        // $order->order_status = "confirmed";
        // $order->update();
    
    //$order->invoice_date = $request['invoice_date'];  

      if($request['confirm_order'] == 'on' && $order->order_status != "confirmed")
      {
        $order->order_status = "confirmed";
     
        if($order->invoice_date == "0000-00-00") {
          if($request['invoice_date'] != "0000-00-00")
            $order->invoice_date = $request['invoice_date'];      
        }
        else $order->invoice_date = date('Y-m-d'); 

        $order->invoice_received = "No";

        $hisab = Hisab::where('party_id','=',$order->customer_id)->where('status','=','ongoing')->first();

        if($hisab == Null){
          $hisab = new Hisab;
          $hisab->party_id = $order->customer_id;
          $hisab->status = "ongoing";
          $hisab->save();
          $order->hisab_id = $hisab->id;
        }
        else $order->hisab_id = $hisab->id;

        $order->update();
        return back();
      }

      if($order->order_status == "confirmed"){
        switch ($request['invoice_received']) {
          case 'No':
            # code...
            $order->invoice_received = "No";
            break;
          
          case 'Yes':
            # code...
            $order->invoice_received = "Yes";
            break;
          
          case 'Lost':
            # code...
            $order->invoice_received = "Lost";
            break;
          
          default:
            # code...
            return back();
            break;
        }

        $order->update();
        return back();
      } // if  invoiced received
        
    }

    // get rid of this
    public function confirm($order)
    {	
    	$order = Order::find($order);
    	$order->order_status = "confirmed";


      $order->update();
      return redirect('/order/'.$order->id);
    } 

    public function modify(Request $request, Order $order)
    {
      
    }
    
      
   
}
