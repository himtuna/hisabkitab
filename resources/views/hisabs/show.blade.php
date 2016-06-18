@extends('layouts.master')

@if($hisab ==  NULL)
	@section('content')
	<div class="alert alert-danger"><strong>No Record Found!</strong> Hisab doesn't exist</div>
	@stop
@else

	@section('page_title','Hisab of '.$hisab->customer->name)

	@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">Hisab of {{$hisab->customer->name}} </div>
		<div class="panel-body">
			Hisab ID: {{$hisab->id}}<br>
				Hisab Status: {{$hisab->status}} <br>
			Party Name: {{$hisab->customer->name}}<br>
		</div>

	</div>

	<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-sign-out"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Credit</span>
              <span class="info-box-number">Rs. {{$hisab->credit}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-sign-in"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Debit</span>
              <span class="info-box-number">Rs. {{$hisab->debit}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon @if(($hisab->credit - $hisab->debit)>0) bg-red @else bg-yellow @endif"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Balance</span>
              <span class="info-box-number">Rs. {{$hisab->credit - $hisab->debit}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
      </div> <!-- /.row -->

<div class="row">
	<div class="col-md-6">
		<div class="panel ">
			<div class="panel-heading bg-aqua">Orders by {{$hisab->customer->name}}</div>
			<div class="panel-body">

			<table class="table table-bordered table-hover">
				<thead>
					<th>ID</th>
					<th class="col-sm-2">Date</th>
					<th>Particulars</th>
					<th class="col-sm-2">Amount</th>
				</thead>
			
			<tbody>
			
				@foreach($hisab->orders as $order)
				<tr>
					<th>
						<a href="{{url('order/'.$order->id)}}" style="color:inherit">
					{{$order->id}}</a>
					</th>
					<td>
						<a href="{{url('order/'.$order->id)}}" style="color:inherit">{{$order->invoice_date}}</a>
					</td>
					<td>
					<?php $totals =array();	$totals = $order->productstotal();
					$i=0; ?>
					
					<a href="#order-detail-{{$order->id}}" data-toggle="collapse">
						@foreach($totals as $total)
							@if($total!=0)
								<strong>{{$products[$i-1]->name}}:</strong> <span class="badge bg-blue"> {{$total}} {{$products[$i-1]->packaging_type}}</span> | 					
							@endif
							<?php $i++?>
						@endforeach
					</a>
					<div id="order-detail-{{$order->id}}" class="collapse">
					@foreach($order->orderlines as $orderline)
						{{$orderline->product->name}} {{$orderline->colour->name}}: {{$orderline->units}} {{$orderline->product->packaging_type}}  <span class="pull-right">x  Rs. {{$orderline->unit_price}} = Rs. {{$orderline->sub_amount}}</span> <br>
					@endforeach
					</div>
					</td>
					<th>Rs. {{$order->amount}}</th>
					
				</tr>
				@endforeach
			</tbody>
			</table>

			</div>
			<div class="panel-footer">Total Orders: {{count($hisab->orders)}} <span class="pull-right">Credit Total = Rs. {{$hisab->credit}}</span></div>
		</div>
	</div>

	<div class="col-md-6">
	<div class="panel">
		<div class="panel-heading bg-green">Payments</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
				<thead>
					<th>ID</th>
					<th>Date</th>
					<th>Amount</th>
				</thead>
				<tbody>
					@foreach($hisab->payments as $payment)
						<tr>
							<td>
							<a href="{{url('payments/'.$payment->id)}}">
							{{$payment->id}}</a></td>
							<td>
							<a href="{{url('payments/'.$payment->id)}}">
							{{$payment->date}}</a></td>
							<th>Rs. {{$payment->debit}}</th>
							
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-footer">Total Payments: {{count($hisab->payments)}} <span class="pull-right">Debit Total = Rs. {{$hisab->debit}}</span> </div>

	</div>
	</div>
	
</div>
@stop
@endif