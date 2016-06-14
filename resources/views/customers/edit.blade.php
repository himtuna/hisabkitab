@extends('layouts.master')

@section('content')

		<div class="panel panel-default">
			<div class="panel-heading">Add new customer</div>
			<div class="panel-body">	
			@if(count($errors))
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">{{ $error }}</div>
			@endforeach
			@endif
				<form action="/customers/{{$customer->id}}" method="post" class="col-lg-6 col-offset-lg-3">
				{{ method_field('PATCH') }}
					<div class="form-group form-inline">
					<label>Name: </label>
						<input type="text" name="customer_name" class="form-control" value="{{$customer->name}}">
					</div>
					<div class="form-group form-inline">
					<label>Phone: </label>
						<input type="text" name="phone" class="form-control" value="{{$customer->phone}}">
					</div>					
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update </button>
					</div>
			{{ csrf_field() }}
				</form>

			</div>
	</div>


	

@endsection
