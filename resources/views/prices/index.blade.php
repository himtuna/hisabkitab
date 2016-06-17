@extends('layouts.master')

@section('content')
<div class="panel panel-primary">
	<div class="panel-heading">Prices for Customers</div>
		<div class="panel-body">	
			<table class="table table-bordered table-hover Orderline-table">
			<thead>
			<th></th>
			@foreach($products as $product)
				<th>{{$product->name}} {{$product->packaging_type}}</th>
			@endforeach
			<th></th>
			<tr>
			<th>Default Price</th>
			@foreach($products as $product)
				<th>Rs. {{$product->unit_price}}</th>				
			@endforeach
			<td><a href="{{url('products')}}"><i class="fa fa-cog"></i></a></td>
			</tr>
			</thead>
			<tbody>

				@foreach($customers as $customer)
					<tr>
						<th>{{$customer->name}}</th>
						@foreach($products as $product)
						<td>@if(NULL !==$product->price($customer))
								Rs. {{$product->price($customer)}}
								@else <span style="color:blue">Rs. {{$product->unit_price}}</span>
								@endif								
						</td>
						@endforeach
						<td><a href="{{url('products')}}"><i class="fa fa-pencil-square-o"></i></a></td>
					</tr>
				@endforeach
			</tbody>
			</table>
	</div>
	<div class="panel-footer"><span style="color:blue">Prices in <em>blue</em> for customers are default prices.</span></div>
</div>
@stop