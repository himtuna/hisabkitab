@extends('layouts.master')
@section('page_title','Edit '. $product->name .' product')

@section('content')

		<div class="panel panel-default">
			<div class="panel-heading">Edit {{$product->name}} product</div>
			<div class="panel-body">	
			@if(count($errors))
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">{{ $error }}</div>
			@endforeach
			@endif
				<form action="/products/{{$product->id}}" method="post" class="col-lg-6 col-offset-lg-3">
				{{ method_field('PATCH') }}
					<div class="form-group form-inline">
					<label>Name: </label>
						<input type="text" name="product_name" class="form-control" value="{{$product->name}}">
					</div>
					<div class="form-group form-inline">
					<label>Category: </label>
						<input type="text" name="category" class="form-control" value="{{$product->category}}">
					</div>
					<div class="form-group form-inline">
					<label for="phone">Packaging Type: </label>
						<select name="packaging_type" class="form-control">
						<option disabled selected value>-select packaging type-</option>
							<option value="Dibbi" @if($product->packaging_type == "Dibbi") selected="selected" @endif>Dibbi</option>
							<option value="Thaili" @if($product->packaging_type == "Thaili") selected="selected" @endif>Thaili</option>
						</select>
					</div>
					<div class="form-group form-inline">
					<label for="phone">Units in a Pack: </label>
						<input type="number" name="pack_units" class="form-control" value="{{$product->pack_units}}">
					</div>
					<div class="form-group form-inline">
					<label for="phone">Pieces in a Unit: </label>
						<input type="number" name="unit_pieces" class="form-control" value="{{$product->unit_pieces}}">
					</div>
					<div class="form-group form-inline">
					<label for="phone">Price: </label>
						<input type="number" name="unit_price" class="form-control" value="{{$product->unit_price}}">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update </button>
					</div>
			{{ csrf_field() }}
				</form>

			</div>
	</div>

@endsection
