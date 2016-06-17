@extends('layouts.master')

@section('page_title','Create a Product Price for a Customer')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Create a Product Price</div>
	<div class="panel-body">
		<form action="{{action('PricesController@store')}}" method="post">
		<div class="form-group col-sm-3">
			<label>Customer</label>
			<select name="customer_id" id="" class="form-control customer_id" required="required">
				<option disabled selected value>Select customer</option>
				@foreach ($customers as $customer )								
					<option value="{{$customer->id}}">{{$customer->name}}</option>
				@endforeach
			</select>
			<p class="help-block">Select the customer</p>
		</div>
		<div class="form-group col-sm-2">
			<label>Product</label>
			<select name="product_id" id="" class="form-control" required="required">
				<option disabled selected value>Select Product</option>
				@foreach ($products as $product )								
					<option value="{{$product->id}}">{{$product->name}} {{$product->packaging_type}}</option>
				@endforeach
			</select>
			<p class="help-block">Select the product</p>
		</div>		
		<div class="form-group col-sm-2">
			<label>Unit Price</label>
			<input type="number" class="form-control" name="unit_price"></input>
			<p class="help-block">Enter unit price</p>
		</div>
			{{csrf_field()}}
			<div class="form-group col-sm-3">	
			<label>Create Price</label>				
			<button type="submit" class="btn btn-primary form-control">Create Price</button>
		</div>
		</form>
	</div>
</div>
@stop