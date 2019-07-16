@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
    @foreach($transactions as $trans)
        <div class="transaction-block">
            <p>{{ date('m-d-Y', strtotime($trans->date_made) ) }}</p>
            <p>{{$trans->transaction_type->name}}: {{$trans->amount}}</p>
        </div>
    @endforeach
@endsection