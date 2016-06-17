@extends('layouts.master')
@section('page_title','Register a Payment from Customer')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Register a Payment from Customer</div>
	<div class="panel-body">	
		<form action="{{action('PaymentsReceivableController@store')}}" method="post">
		<div class="form-group col-sm-3">
			<label>Customer</label>
			<select name="customer_id" id="" class="form-control" required="required">
				<option disabled selected value>Select customer</option>
				@foreach ($customers as $customer )								
					<option value="{{$customer->id}}">{{$customer->name}}</option>
				@endforeach
			</select>
			<p class="help-block">Select the customer</p>
		</div>
		<div class="form-group col-sm-3">
			<label>Amount</label>
			<input type="number" name="amount" class="form-control" required="required"></input>
			<p class="help-block">Enter amount received</p>	
		</div>

		<div class="form-group col-sm-3">
			<label>Date </label>
			<input type="date" name="date" class="form-control" required="required"></input>
			<p class="help-block">Enter date of payment</p>	
		</div>

		{{ csrf_field() }}
		<div class="form-group col-sm-3">	
			<label>Register Payment</label>				
			<button type="submit" class="btn btn-primary form-control">Register Payment</button>
		</div>
		</form>
	</div>
</div>
			


@stop