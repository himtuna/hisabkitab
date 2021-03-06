@extends('layouts.master')
@section('script_head')
<script type="text/javascript">
	$(function(){
		$('.addOrderline').click(function(){
			var product_list = $('.product_list').html();
			var colour_code = $('.colour_code').html();
			var orderline_number = ($('.Orderline-table tr').length-0);
			var orderline = '<tr><th class="no">'+ orderline_number +'</th>' +
					'<td><select name="product_id[]" class="form-control product_list" required="required">'+ product_list + '</select></td>' +
					'<td><select name="colour_id[]" class="form-control" required="required">'+ colour_code +'</select></td>' +
					'<td><input type="number" min="0" name="nag[]" class="nag form-control" required="required"></td>' +
					'<td><input type="number" min="1" name="qty[]" class="qty form-control" required="required"></td>' +
					'<td><a href="#" class="btn btn-danger delOrderline">X</a></td></tr>';
			$('.Orderline-table').append(orderline);
		});

		$('.Orderline-table').delegate('.delOrderline','click', function(){
			$(this).parent().parent().remove();
		});

		$('.Orderline-table').delegate('.product_list','change', function(){
			 var orderline = $(this).parent().parent();
			 orderline.find('.nag').val('');
			 orderline.find('.qty').val('');
				
		});

		$('.Orderline-table').delegate('.nag,.qty','keyup', function(){
			var orderline = $(this).parent().parent();
			var nag = orderline.find('.nag').val()-0;
			var pack_units = orderline.find('.product_list option:selected').attr('data-packunits');
			var qty = pack_units * nag;
			orderline.find('.qty').val(qty);
		});    
	});
</script>
<link href="{{asset('/assets/select2/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('/assets/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" />
<script src="{{asset('/assets/select2/js/select2.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $(".select2").select2();
   theme: "bootstrap"
});
</script>

@stop
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Add new order</div>
			<div class="panel-body">
			@if(count($errors))
				@foreach($errors->all() as $error)
					<div class="alert alert-danger" role="alert">{{ $error }}</div>
				@endforeach
			@endif
				<form action="{{action('OrdersController@storeorder')}}" method="post">
				<div class="row">
					<div class="col-lg-12">
						
							<div class="form-group col-sm-3">
								<label>Customer</label>
								<select name="customer_id" id="" class="form-control customer_id select2" required="required">
										<option disabled selected value>Select customer</option>
										 @foreach($customers as $customer ) 
											<option value="{{$customer->id}}">{{$customer->name}}</option>
										@endforeach

									</select>

								<p class="help-block">Select the customer</p>
							</div>
							<div class="form-group col-sm-3">
								<label>Order Creation Date</label>
								<input type="date" class="form-control order_created_on" name="order_created_on" id="order_created_on" required="required">
								<p class="help-block">Select the order date</p>
							</div>		
							<div class="form-group col-sm-3">	
								<label>Save order</label>				
								<button type="submit" class="btn btn-primary form-control">Submit</button>
							</div>
						
					</div><!-- /.col-lg-12 -->

					<div class="col-lg-12">
						<table class="table table-bordered table-hover Orderline-table">
							<thead>
								<th>#</th>
								<th>Product</th>
								<th>Colour</th>
								<th>Nag</th>
								<th>Qty</th>
								<th><input type="button" class="btn btn-primary addOrderline" value="+"></th>
							</thead>
							<tbody>
								<tr>
								<th class="no">1</th>
								<td>
									<select required="required" name="product_id[]" class="form-control product_list">
										<option disabled selected value> Select product </option>
										<?php
											 foreach ($products as $product ) {
											?>								
											<option data-packunits="<?= $product->pack_units; ?>" value="<?= $product->id; ?>"><?= $product->name; ?></option>
											<?php
										}
										?>
									</select>
								</td>
								<td>
									<select name="colour_id[]" class="form-control colour_code" required="required" >
										<option disabled selected value>Colour</option>
										<?php
											 foreach ($colours as $colour ) {
											?>								
											<option value="<?= $colour->id; ?>"><?= $colour->name; ?></option>
											<?php
										}
										?>

									</select>
								</td>
								<td>
									<input type="number" min="0" name="nag[]" class="nag form-control" required="required">
								</td>
								<td>
									<input type="number" min="1" name="qty[]" class="qty form-control" required="required">
								</td>
								<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>

@stop