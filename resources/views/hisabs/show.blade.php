@extends('layouts.master')

@if($hisab ==  NULL)
	@section('content')
	<div class="alert alert-danger"><strong>No Record Found!</strong> Hisab doesn't exist</div>
	@stop
@else

	@section('page_title','Hisab of '.$hisab->customer->name)

	@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Hisab of {{$hisab->customer->name}} </div>
		<div class="panel-body">
			Hisab ID: {{$hisab->id}}<br>
			Hisab Status: {{$hisab->status}} <br>
			Party Name: {{$hisab->customer->name}}<br>
		</div>

	</div>
		
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Orders</div>
			<div class="panel-body">
			<table class="table table-bordered table-hover">
				<thead>
					<th>Order ID</th>
					<th>Date</th>
					<th>Units</th>
				</thead>
			
			<tbody>
			Total Orders: {{count($hisab->orders)}}
				@foreach($hisab->orders as $order)
				<tr>
					<td>{{$order->id}}</td>
					<td>{{$order->invoice_date}}</td>
					<td>
					<?php 
					$totalp =array();
					$totalp = $order->productstotal();
					$i=0;
					?>
					<a href="#order-detail-{{$order->id}}" data-toggle="collapse" class="fa fa-expand">
					@foreach($totalp as $total)
						@if($total!=0)
						<br>{{$products[$i-1]->name}}: {{$total}} {{$products[$i-1]->packaging_type}}
					@endif
						<?php $i++?>
					@endforeach
					</a>
					<br>
					<div id="order-detail-{{$order->id}}" class="collapse">
					@foreach($order->orderlines as $orderline)
						{{$orderline->product->name}} {{$orderline->colour->name}}: {{$orderline->units}} {{$orderline->product->packaging_type}}
					@endforeach
					</div>
					</td>
				</tr>
				@endforeach
			</tbody>
			</table>
			</div>
		</div>
	</div>

	<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">Payments</div>
		<div class="panel-body">
			testngs
		</div>

	</div>
	</div>
	

@stop
@endif