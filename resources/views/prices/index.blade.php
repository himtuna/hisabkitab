@extends('layouts.master')

@section('content')

<div class="col-lg-12">
	<div class="panel panel-primary">
		<div class="panel-heading">Default Prices</div>
		<div class="panel-body">	

			<table class="table table-bordered table-hover Orderline-table">
			<th>#</th>
			<th>Product</th>
			<th>Packaging Type</th>
			<th>Price</th>
			<th>Last updated</th>
			
			<tbody>
				@foreach($products as $product)
				<tr>
					<td></td>
					<td>{{$product->name}}</td>
					<td>{{$product->packaging_type}}</td>
					<td>Rs. {{$product->unit_price}}</td>
					<td>{{$product->updated_on}}</td>
				</tr>
				@endforeach
			</tbody>
			</table>

			@foreach($unit_prices as $unit_price)
				Price: {{$unit_price->unit_price}}<br>
			@endforeach
		</div>
	</div>
</div>


@stop