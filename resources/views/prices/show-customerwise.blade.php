@extends('layouts.master')

@section('page_title','Prices for '.$customer->name)

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Prices for {{$customer->name}}</div>
	<div class="panel-body">
	<form action="{{url('customers/'.$customer->id.'/prices')}}" method="post">
		{{ method_field('PATCH') }}
		<table class="table table-bordered tabel-hovered">
			<thead>
				<th>ID</th>
				<th>Product</th>
				<th class="col-sm-3">Price</th>						
				
			</thead>
			<tbody>
				@foreach($products as $product)
				<tr>
					<td>{{$product->id}}</td>
					<td>{{$product->name}} {{$product->packaging_type}}</td>
					<th>
					<div class="input-group">
						<div class="input-group-addon bg-green" style="font-size:1.5em">&#8377;</div>
						<input type="number" min="0" @if(NULL !==$product->price($customer))
						value="{{$product->price($customer)}}" @endif class="form-control col-sm-2" name="product-{{$product->id}}" placeholder="{{$product->unit_price}}"></input>
					</div>						
					</th>
					
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ csrf_field()}}
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Update Prices</button>
		</div>
		</form>
	</div>
	<div class="panel-footer">
		
	</div>
</div>
@stop