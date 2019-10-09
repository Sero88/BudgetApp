@extends('layouts.app')
@section('title', $balance->name)

@section('content')
    <p>{{$balance->amount}}</p>
	@include('balances.balance-categories')
	@include('transactions.list',['object' => $balance])
@endsection
