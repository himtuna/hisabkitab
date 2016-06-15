@extends('layouts.master')
@section('page_title','Edit '. $colour->name .' colour')

@section('content')

		<div class="panel panel-default">
			<div class="panel-heading">Edit {{$colour->name}} colour</div>
			<div class="panel-body">	
			@if(count($errors))
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">{{ $error }}</div>
			@endforeach
			@endif
				<form action="/colours/{{$colour->id}}" method="post" class="col-lg-6 col-offset-lg-3">
				{{ method_field('PATCH') }}
					<div class="form-group form-inline">
					<label>Name: </label>
						<input type="text" name="colour_name" class="form-control" value="{{$colour->name}}">
					</div>
					<div class="form-group form-inline">
					<label>Name in Hindi: </label>
						<input type="text" name="colour_name_hi" class="form-control" value="{{$colour->name_hi}}">
					</div>
					<div class="form-group form-inline">
					<label for="code">Colour Code: </label>
						<input type="text" name="code" class="form-control" value="{{$colour->code}}">
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update </button>
					</div>
			{{ csrf_field() }}
				</form>

			</div>
	</div>

@endsection
