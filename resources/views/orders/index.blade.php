@extends('layouts.master')

@section('content')
<div class="row">
	@if(count($orders) == 0)
		
		<div class="alert alert-info col-lg-12">
		@if(Request::segment(2) == "draft")
	  		<strong>No Draft Orders!</strong> There are no new draft orders from customers.
	  	@elseif(Request::segment(2) == "confirmed")
	  		<strong>No Confirmed Orders!</strong> There are no new confirmed orders from customers.
	  	@elseif(Request::segment(2) == "lost")
	  		<strong>No Record Found!</strong> There are no invoices which are lost recently.
	  	@elseif(Request::segment(2) == "received")
	  		<strong>No Received Invoices!</strong> There are no invoices received recently.
		@endif
		</div>
		
	@else
		@foreach($orders as $order)
		<div class="col-lg-4">
			<div class="panel 
			@if($order->order_status == 'paid' || $order->invoice_received == 'Yes') panel-primary
			@elseif($order->order_status == 'draft') panel-default 
			@elseif($order->order_status == 'confirmed' && $order->invoice_received != 'Lost') panel-success 
			@elseif($order->invoice_received == 'Lost' && $order->order_status != 'paid') panel-danger @endif">
				<div class="panel-heading">
					<a href="/order/{{$order->id}}" style="color:inherit; text-decoration: none; ">{{ $order->customer->name}} 
					<small class="pull-right">@if($order->invoice_date!="0000-00-00") Invoice dt. {{ $order->order_created_on }} @else Order dt. {{$order->order_created_on}} @endif</small></a>
				</div>
				<div class="panel-body">
				@foreach($order->orderlines as $orderline)
					<p>{{$orderline->product->name}} - {{$orderline->colour['name']}} : {{$orderline->units}} {{$orderline->product->packaging_type}}</p>
					@endforeach
				</div>
				<div class="panel-footer">
					<small>Order ID: {{ $order->id }} <span class="pull-right">Status: {{$order->order_status}} @if($order->invoice_received == 'Lost') and Invoice lost @endif</span></small>
				</div>
			</div>
		</div>
		@endforeach
	@endif
</div>
@stop
