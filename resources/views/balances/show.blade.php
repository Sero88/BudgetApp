@extends('layouts.app')
@section('title', $balance->name)

@section('content')
    @include('balances.actuals-vs-budget')
	@include('balances.balance-categories')
	@include('transactions.list',['object' => $balance])
@endsection
