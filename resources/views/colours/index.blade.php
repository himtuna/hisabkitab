@extends('layouts.master')
@section('page_title', 'Colours')
@section('content')
<div class="panel panel-primary">
		<div class="panel-heading">Colours</div>
		<div class="panel-body">	

			<table class="table table-bordered table-hover Orderline-table">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Name in Hindi</th>
					<th>Colour code</th>					
					<th><i class="fa fa-cog fa-fw" aria-hidden="true"></i></th>
				</thead>
				<tbody>
				
					@foreach($colours as $colour)
					<tr>
					<td>{{ $colour->id }}</td>
					<td>{{ $colour->name }}</td>
					<td>{{ $colour->name_hi }}</td>
					<td>{{ $colour->code }}</td>									
					<td><a href="/colours/{{$colour->id}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
					</tr>
					@endforeach
				
				</tbody>
			</table>	
		</div>
	</div>	

		<div class="panel panel-default">
			<div class="panel-heading">Add new colour</div>
			<div class="panel-body">	
			@if(count($errors))
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">{{ $error }}</div>
			@endforeach
			@endif
				<form action="/colours" method="post" class="col-lg-6 col-offset-lg-3">
					<div class="form-group form-inline">
					<label>Name: </label>
						<input type="text" name="colour_name" class="form-control">
					</div>
					<div class="form-group form-inline">
					<label>Name in Hindi: </label>
						<input type="text" name="colour_name_hi" class="form-control">
					</div>
					<div class="form-group form-inline">
					<label for="phone">Code: </label>
						<input type="text" name="code" class="form-control">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Add colour</button>
					</div>
			{{ csrf_field() }}
				</form>

			</div>
		</div>
	
@endsection
