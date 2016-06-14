@extends('layouts.master')

@section('content')
<div class="row">
@if(count($countordersbyCustomers)==0)
<div class="alert alert-info col-lg-12">
	<strong>No Orders of any Customer!</strong> There are no confirmed orders from any customer.
</div>
@else
	@foreach($countordersbyCustomers as $customer)	
	<div class="col-lg-4">
		<div class="panel panel-primary">
			<div class="panel-heading"><a href="/customers/{{$customer->customer_id}}/orders" style="color:inherit">{{$customers[$customer->customer_id-1]->name}}</a></div>
			<div class="panel-body">
				
			@foreach($orderstotalbyCustomers as $order)					
				@if($order->customer_id == $customer->customer_id)		
				{{$products[$order->product_id-1]->name}} : {{$order->units}} {{$products[$order->product_id-1]->packaging_type}}<br>
				@endif
			@endforeach
					
			</div>
			<div class="panel-footer">
				Total Invoices: {{$customer->total_orders}}
			</div>
		</div>
	</div>
	@endforeach	
@endif

</div>
@stop	