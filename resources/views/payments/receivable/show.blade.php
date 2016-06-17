@extends('layouts.master')
@section('page_title','Payment received from '.$payment->customer->name)

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Payment received from {{$payment->customer->name}} </div>
		<div class="panel-body">
			Payment ID: {{$payment->id}}<br>
			Payment Date: {{$payment->date}}<br>
			Party Name: {{$payment->customer->name}}<br>
			Payment Amount: Rs. {{$payment->debit}}<br>
			<a href="{{url('hisab/'.$payment->hisab->id)}}">Hisab #{{$payment->hisab->id}}</a>

		</div>
		<div class="panel-footer">
			Record created on: {{$payment->created_at}} <span>Last updated one: {{$payment->updated_at}}</span>
		</div>
	</div>
@stop