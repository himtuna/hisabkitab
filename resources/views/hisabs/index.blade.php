@extends('layouts.master')

@section('page_title', 'Hisab')

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">Hisab</div>
	<div class="panel-body">
		<table class="table table-bordered table-hover">
			<thead>
				<th>#</th>
				<th>Status</th>
				<th>Customer Name</th>
				<th>Date</th>
				<th>Credit</th>
				<th>Debit</th>
				<th>Discount</th>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
@stop