<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;

class ProductsController extends Controller
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
        $products= Product::all();
        return view('products.index', compact('products'));
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
        $product = new Product;

        $this->validate($request, [
            'product_name' => 'required',
            'category' => 'required',
            'pack_units' => 'required',
            'unit_pieces' => 'required',
            'unit_price' =>'required|min:1'
        ]);

        $product->name = $request->product_name;
        $product->category = $request->category;
        $product->pack_units = $request->pack_units;
        $product->unit_pieces = $request->unit_pieces;
        $product->unit_price = $request->unit_price;        
        $product->save();

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
        $product = Product::find($id);
        return view('products.edit', compact('product'));
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
        $product = Product::find($id);
        // $product->update($request->all());

        $product->name = $request->product_name;
        $product->category = $request->category;
        $product->packaging_type = $request->packaging_type;
        $product->pack_units = $request->pack_units;
        $product->unit_pieces = $request->unit_pieces;
        $product->unit_price = $request->unit_price;        
        $product->save();
        return redirect('/products');
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
