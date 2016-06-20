@extends('layouts.master')

@section('page_title', 'Hisab')

@section('content')
<div class="box">
	<div class="box-header with-border">Hisab Cashflow</div>
	<div class="box-body">
		<div class="row">
			<div class="col-sm-4 description-block">
				<?php $credit=0; $debit=0;?>
				@foreach($hisabs as $hisab)
					<?php $credit+=$hisab->credit; $debit+=$hisab->debit; ?>
				@endforeach
				<h5 class="description-header">Rs. {{$credit}}</h5>
				<span class="description-text">Total Sales</span>
			</div>
			<div class="col-sm-4 description-block">
				<h5 class="description-header">Rs. {{$debit}}</h5>
				<span class="description-text">Total Payment</span>
			</div>
			<div class="col-sm-4 description-block">
				<h5 class="description-header">Rs. {{$credit - $debit}}</h5>
				<span class="description-text">Balance</span>
			</div>
		</div>
	</div>
	<div class="box-footer">
		
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Hisab of Customers</div>
	<div class="panel-body">
		<table class="table table-bordered table-hover">
			<thead>
				<th>#</th>
				<th>Customer Name</th>				
				<th>Status</th>
				<th>Credit</th>
				<th>Debit</th>
				<th>Balance</th>
				<th><i class="fa fa-cog" aria-hidden="true"></i></th>
			</thead>
			<tbody>
				@foreach($hisabs as $hisab)
					<tr>
						<th><a href="{{url('hisab/'.$hisab->id)}}">{{$hisab->id}}</a></th>
						<td>{{$hisab->customer->name}}</td>	
						<td>{{$hisab->status}}</td>								
						<td>Rs. {{$hisab->credit}}</td>
						<td>Rs. {{$hisab->debit}}</td>
						<td>Rs. {{$hisab->debit - $hisab->credit}}</td>
						<td><a href="{{url('hisab/'.$hisab->id)}}"><i class="fa fa-link" aria-hidden="true"></i></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop