@extends('layouts.app')
<div>
    @section('title', 'Recurring Transactions')
</div>


@section('content')
    <a href="{{route('recurring-transactions.create')}}">+ New Recurring Transaction</a>
    <hr>
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
            <p>{{$trans->description}}</p>
            <p>Next transaction day: {{ Carbon\Carbon::create($trans->day_of_month)->format('l, M. d, Y') }}</p>
            <p>{{$trans->budgetCategory->name}} | {{$trans->transactionType->name}}: ${{$trans->amount}} | {{$trans->paymentType->name}}</p>
            <p><a href="{{ route('recurring-transactions.edit', compact('trans') ) }}">Edit</a></p>
            <div>
                <form method="post" action="{{ route('recurring-transactions.destroy', compact('trans') ) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </div>
        </div>
        <hr>
    @endforeach
@endsection
