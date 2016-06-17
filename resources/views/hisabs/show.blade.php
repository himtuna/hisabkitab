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

			<?php $debit=0; $credit=0;?>
		</div>

	</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">Orders by {{$hisab->customer->name}}</div>
			<div class="panel-body">

			<table class="table table-bordered table-hover">
				<thead>
					<th>ID</th>
					<th class="col-sm-2">Date</th>
					<th>Particulars</th>
					<th class="col-sm-2">Amount</th>
				</thead>
			
			<tbody>
			
				@foreach($hisab->orders as $order)
				<tr>
					<th>
						<a href="{{url('order/'.$order->id)}}" style="color:inherit">
					{{$order->id}}</a>
					</th>
					<td>
						<a href="{{url('order/'.$order->id)}}" style="color:inherit">{{$order->invoice_date}}</a>
					</td>
					<td>
					<?php $totals =array();	$totals = $order->productstotal();
					$i=0; $amount = 0;?>
					
					<a href="#order-detail-{{$order->id}}" data-toggle="collapse">
						@foreach($totals as $total)
							@if($total!=0)
								<strong>{{$products[$i-1]->name}}:</strong> <span class="badge bg-blue"> {{$total}} {{$products[$i-1]->packaging_type}}</span> | 
								<?php $amount+= $total*$products[$i-1]->unit_price; ?>
							@endif
							<?php $i++?>
						@endforeach
					</a>
					<div id="order-detail-{{$order->id}}" class="collapse">
					@foreach($order->orderlines as $orderline)
						{{$orderline->product->name}} {{$orderline->colour->name}}: {{$orderline->units}} {{$orderline->product->packaging_type}} <br>
					@endforeach
					</div>
					</td>
					<th>Rs. {{$amount}}</th>
					<?php $credit+=$amount; ?>
				</tr>
				@endforeach
			</tbody>
			</table>

			</div>
			<div class="panel-footer">Total Orders: {{count($hisab->orders)}} <span class="pull-right">Credit Total = Rs. {{$credit}}</span></div>
		</div>
	</div>

	<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading">Payments</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
				<thead>
					<th>ID</th>
					<th>Date</th>
					<th>Amount</th>
				</thead>
				<tbody>
					@foreach($hisab->payments as $payment)
						<tr>
							<td>
							<a href="{{url('payments/'.$payment->id)}}">
							{{$payment->id}}</a></td>
							<td>
							<a href="{{url('payments/'.$payment->id)}}">
							{{$payment->date}}</a></td>
							<th>Rs. {{$payment->debit}}</th>
							<?php $debit+=$payment->debit; ?>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-footer">Total Payments: {{count($hisab->payments)}} <span class="pull-right">Debit Total = Rs. {{$debit}}</span> </div>

	</div>
	</div>
	
</div>
@stop
@endif