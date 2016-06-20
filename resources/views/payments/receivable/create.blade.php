@extends('layouts.master')
@section('page_title','Register a Payment from Customer')
@section('script_head')
<link href="{{asset('/assets/select2/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('/assets/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" />
<script src="{{asset('/assets/select2/js/select2.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $(".select2").select2();   
});
$.fn.select2.defaults.set( "theme", "bootstrap" );
</script>
@stop
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Register a Payment from Customer</div>
	<div class="panel-body">	
		<form action="{{action('PaymentsReceivableController@store')}}" method="post">
		<div class="form-group col-sm-3">
			<label>Customer</label>
			<select name="customer_id" id="" class="form-control select2" required="required">
				<option disabled selected value>Select customer</option>
				@foreach ($customers as $customer )								
					<option value="{{$customer->id}}" class="form-control">{{$customer->name}}</option>
				@endforeach
			</select>
			<p class="help-block">Select the customer</p>
		</div>
		<div class="form-group col-sm-3">
			<label>Amount</label>
			<div class="input-group">
				<div class="input-group-addon bg-green" style="font-size:1.5em">&#8377;</div>
				<input type="number" name="amount" class="form-control" required="required"></input>
			</div>
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