@extends('layouts.master')

@section('content')
<div class="col-lg-12">
	<div class="panel panel-primary">
		<div class="panel-heading">Products</div>
		<div class="panel-body">	

			<table class="table table-bordered table-hover Orderline-table">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Pack Units</th>
					<th>Pieces per unit</th>
					<th>Price</th>
					<th><i class="fa fa-cog fa-fw" aria-hidden="true"></i></th>
				</thead>
				<tbody>
				
					@foreach($products as $product)
					<tr>
					<td>{{ $product->id }}</td>
					<td>{{ $product->name }}</td>
					<td>{{ $product->pack_units }} {{$product->packaging_type}}</td>
					<td>{{ $product->unit_pieces }} piece</td>
					<td>Rs. {{ $product->unit_price }}</td>					
					<td><a href="/products/{{$product->id}}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
					</tr>
					@endforeach
				
				</tbody>
			</table>	
		</div>
	</div>	
</div>

	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Add new product</div>
			<div class="panel-body">	
			@if(count($errors))
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">{{ $error }}</div>
			@endforeach
			@endif
				<form action="products" method="post" class="col-lg-6 col-offset-lg-3">
					<div class="form-group form-inline">
					<label>Name: </label>
						<input type="text" name="product_name" class="form-control">
					</div>
					<div class="form-group form-inline">
					<label>Category: </label>
						<input type="text" name="category" class="form-control">
					</div>
					<div class="form-group form-inline">
					<label for="phone">Packaging Type: </label>
						<select name="packaging_type" class="form-control">
							<option value="Dibbi" selected="selected">Dibbi</option>
							<option value="Thaili">Thaili</option>
						</select>
					</div>
					<div class="form-group form-inline">
					<label for="phone">Units in a Pack: </label>
						<input type="number" name="pack_units" class="form-control">
					</div>
					<div class="form-group form-inline">
					<label for="phone">Pieces in a Unit: </label>
						<input type="number" name="unit_pieces" class="form-control">
					</div>
					<div class="form-group form-inline">
					<label for="phone">Price: </label>
						<input type="number" name="unit_price" class="form-control">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Add product</button>
					</div>
			{{ csrf_field() }}
				</form>

			</div>
		</div>

	</div>

@endsection
