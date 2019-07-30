@extends('layouts.app');
@section('title', $balance->name)

@section('content')
    @include('balances.actuals-vs-budget')
	@include('balances.balance-categories')
	@include('balances.balance-transactions')
@endsection
