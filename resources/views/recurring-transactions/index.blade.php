@extends('layouts.app')

@section('title', 'Recurring Transactions')

@section('content')
    @foreach($recurringTransactions as $trans)
        @if(session('message'))
        <div>
            {{session('message')}}
            <hr>
        </div>
        @endif
        <div class="transaction-block">
            <h2>{{$trans->name}}</h2>
            <p>{{$trans->transactionInterval->name}}</p>
            <p>Next transaction day: {{ Carbon\Carbon::create($trans->day_of_month)->format('l, M. d, Y') }}</p>
            <p>{{$trans->budgetCategory->name}} | {{$trans->transactionType->name}}: ${{$trans->amount}}</p>
            <p><a href="/transactions/{{$trans->id}}/edit">Edit</a></p>
            <div>
                <form method="post" action="/transactions/{{$trans->id}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        </div>
        <hr>
    @endforeach
@endsection
