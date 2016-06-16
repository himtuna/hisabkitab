@extends('layouts.master')
@section('page_title','Create a Hisab')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Create a Hisab</div>
	<div class="panel-body">	
		<form action="{{action('HisabsController@store')}}" method="post">
		<div class="form-group col-sm-3">
			<label>Customer</label>
			<select name="customer_id" id="" class="form-control customer_id" required="required">
				<option disabled selected value>Select customer</option>
				@foreach ($customers as $customer )								
					<option value="{{$customer->id}}">{{$customer->name}}</option>
				@endforeach
			</select>
			<p class="help-block">Select the customer</p>
		</div>
		<div class="form-group col-sm-3">
			<label>Hisab Status</label>
			<select name="hisab_status" id="" class="form-control" required="required">
			<option default selected value>-select status-</option>			
			<option value="ongoing">Ongoing</option>			
			</select>
		</div>

		{{ csrf_field() }}
		<div class="form-group col-sm-3">	
			<label>Add Hisab</label>				
			<button type="submit" class="btn btn-primary form-control">Add Hisab</button>
		</div>
		</form>
	</div>
</div>
			


@stop