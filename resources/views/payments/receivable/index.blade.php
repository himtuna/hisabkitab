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
					<th>ID</th>
					<th>Date</th>
					<th>Customer</th>
					<th>Amount</th>
				</thead>
				<tbody>
					@foreach($payments as $payment)
						<tr>
							<td>{{$payment->id}}</td>
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