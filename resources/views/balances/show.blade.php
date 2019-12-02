@extends('layouts.app')
@section('title', $balance->name)

@section('content')

    @if(!empty($balance->description))
        <p>{{$balance->description}}</p>
    @endif

    <p>{{$balance->amount}}</p>
	@include('balances.balance-categories')
    <hr>
	@include('transactions.list',['object' => $balance])
@endsection
