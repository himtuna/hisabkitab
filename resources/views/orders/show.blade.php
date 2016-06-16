@extends('layouts.master')
@section('content')
<div class="panel @if($order->order_status == 'paid' || $order->invoice_received == 'Yes') panel-primary
		@elseif($order->order_status == 'draft') panel-default 
		@elseif($order->order_status == 'confirmed' && $order->invoice_received != 'Lost') panel-success 
		@elseif($order->invoice_received == 'Lost' && $order->order_status != 'paid') panel-danger @endif">
	<div class="panel-heading">{{$order->customer->name}}</div>	
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-4"><label>Customer</label><h3>{{$order->customer->name}}</h3></div>
			@if($order->invoice_date == "0000-00-00" and $order->order_created_on !="000-00-00")
				<div class="col-lg-4"><label>Order created on</label><h3>{{$order->order_created_on}}</h3></div>
			@elseif($order->invoice_date != "0000-00-00")
				<div class="col-lg-4">
					<label>Invoice Date</label><h3>{{$order->invoice_date}}</h3>
					<small>Order created on: {{$order->order_created_on}}</small>
				</div>
			@endif
			
			
			
			<div class="col-lg-4">
			<form action="/order/{{$order->id}}" method="post">
			{{ method_field('PATCH') }}
				<div class="form-group">	
							<label for="invoice_received">Delete this invoice? Click </label>	
						<a href="/order/{{$order->id}}/delete"><button type="button" class="btn btn-danger btn-xs">Delete</button></a>
				</div>
				<div class="form-group form-inline">				
				@if($order->invoice_date == "0000-00-00")
					<hr>
						<label>Invoice Date:</label>
								<input type="date" class="form-control invoice_date" name="invoice_date" id="invoice_date" required="required">
						<p class="help-block">Change invoice date</p>
						
				@endif
				@if($order->order_status == 'draft')
						<hr>
						<label for="confirm_order">Confirm order: </label><input type="checkbox" name="confirm_order" aria-label="confirm order" class="" required="required"></input>
						
				@elseif($order->order_status == 'confirmed')
					<label for="invoice_received">Invoice Received: </label>
					<select name="invoice_received" class="form-control">
						<option disabled selected value>--</option>
						<option value="No" @if($order->invoice_received == 'No') selected="selected" @endif>No</option>
						<option value="Yes" @if($order->invoice_received == 'Yes') selected="selected" @endif>Yes</option>
						<option value="Lost" @if($order->invoice_received == 'Lost') selected="selected" @endif>Lost</option>
					</select>
				@endif	
				</div>			
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Update Invoice</button>
				</div>
				{{ csrf_field() }}
			</form>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-bordered table-hover Orderline-table">
					<thead>
						<th>#</th>
						<th>Product</th>
						<th>Colour</th>
						<th>Nag</th>
						<th>Qty</th>
						<th><input type="button" class="btn btn-primary addOrderline" value="+"></th>
					</thead>
					<tbody>
						<?php $i=0;?>
						@foreach($order->orderlines as $orderline)
						<tr>
						<th><?php $i++; echo $i;?></th>
						<td>{{$orderline->product->name}}</td>
						@if($orderline->colour == Null)
							<td></td>
						@else <td>{{$orderline->colour->name}}</td>@endif
						<td><?php $nag = $orderline->units/$orderline->product->pack_units; echo $nag;?></td>		
						<td>{{$orderline->units}} {{$orderline->product->packaging_type}}</td>
						<td></td>
						</tr>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>

	</div>
	
	<div class="panel-footer"> @if($order->order_status !="draft")
		<a href="{{url('hisab/'.$order->hisab_id)}}">Hisab #{{$order->hisab_id}}</a> |
	@endif Record created at: {{$order->created_at}}. <em class="pull-right">Last updated at: {{$order->updated_at}}</em></div>
</div>

@stop