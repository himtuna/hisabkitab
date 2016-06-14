@extends('layouts.master')
@section('page_title', 'Orders by '.$customer->name)
@section('content')


	<div class="panel panel-primary">
		<div class="panel-heading">Orders by {{$customer->name}}</div>
		<div class="panel-body">	
		<h4>{{$customer->name}}</h4>
		<p>Total orders: {{count($orders)}}</p>
			

<!-- Another Table -->
			<table class="table table-bordered table-hover Orderline-table">
			<thead>
				<th>#</th>
				<th>Order Id</th>
				<th>Invoice Date</th>
				<th>Product</th>										
				<th>Units</th>
			</thead>
			<tbody>
					
					@foreach($ordersbyProducts as $ordersbyProduct)
					@foreach($orders as $order)
						@if($order->id == $ordersbyProduct->id)
						
						<tr>
							<td></td>
							<td><a  href="/order/{{$ordersbyProduct->id}}" style="color:inherit;text-decoration:none">{{$ordersbyProduct->id}}</a></td>
							<td>{{$order->invoice_date}}</td>
							<td>{{$products[$ordersbyProduct->product_id-1]->name}}</td>
							<td>{{$ordersbyProduct->units}} {{$products[$ordersbyProduct->product_id-1]->packaging_type}}
							</td>
						</tr>
						
						@endif
					@endforeach
				@endforeach
				</tbody>
			</table>
				
		</div>
	</div>

@stop	