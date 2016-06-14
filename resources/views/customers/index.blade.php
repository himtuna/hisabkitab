@extends('layouts.master')

@section('content')
<div class="col-lg-12">
	<div class="panel panel-primary">
		<div class="panel-heading">Customers</div>
		<div class="panel-body">	

			<table class="table table-bordered table-hover Orderline-table">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Phone</th>
					<th><i class="fa fa-cog fa-fw" aria-hidden="true"></i></th>
				</thead>
				<tbody>
				
					@foreach($customers as $customer)
					<tr>
					<td>{{ $customer->id }}</td>
					<td>{{ $customer->name }}</td>
					<td>{{ $customer->phone }}</td>
					<td><a href="/customers/{{$customer->id}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
					</tr>
					@endforeach
				
				</tbody>
			</table>	
		</div>
	</div>	
</div>

	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Add new customer</div>
			<div class="panel-body">	
			@if(count($errors))
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">{{ $error }}</div>
			@endforeach
			@endif
				<form action="customers" method="post" class="form-inline">
					<div class="form-group">
					<label>Name: </label>
						<input type="text" name="customer_name" class="form-control">
					</div>
					<div class="form-group">
					<label for="phone">Phone: </label>
						<input type="text" name="phone" class="form-control">
					</div>
					<div class="form-group">
				<button type="submit" class="btn btn-primary">Add customer</button>
			</div>
			{{ csrf_field() }}
				</form>

			</div>
		</div>

	</div>

@endsection
