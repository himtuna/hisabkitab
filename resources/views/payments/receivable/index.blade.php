@extends('layouts.master')

@section('page_title', 'Payments Receivable')

@section('content')
@if(count($payments) == 0)
	<div class="alert alert-info col-lg-12">
  		<strong>No Recent Payments!</strong> There are no recent payments from customers recently.
	</div>
@else
<form action="payments/receivable" method="POST">
	

</form>
	<div class="panel panel-default">
		<div class="panel-heading">Payments</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
				<thead>
					<th class="col-sm-1">Payment ID</th>
					<th>Hisab ID</th>
					<th>Date</th>
					<th>Customer</th>
					<th>Amount</th>
				</thead>
				<tbody>
					@foreach($payments as $payment)
						<tr>
							<td><a href="{{url('payments/'.$payment->id)}}">{{$payment->id}}</a></td>
							<td><a href="{{url('hisab/'.$payment->hisab_id)}}">Hisab #{{$payment->hisab_id}}</a></td>
							<td>{{$payment->date}}</td>
							<td>{{$payment->customer->name}}</td>
							<td>Rs. {{$payment->debit}}</td>
						</tr>						
					@endforeach
				</tbody>
			</table>

		</div>
	</div>

@endif
@stop