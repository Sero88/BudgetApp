@extends('layouts.app');
@section('title', $balance->name)

@section('content')
    @foreach($transactions as $trans)
        {{$trans->amount}}
    @endforeach
@endsection
