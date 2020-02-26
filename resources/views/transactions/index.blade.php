@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
    @foreach($transactions as $trans)
        @if(session('message'))
        <div>
            {{session('message')}}
            <hr>
        </div>
        @endif
        <div class="transaction-block">
            @if($trans->sub_budget_category_id)
                <p>{{$trans->budgetCategory->balance->name}}: {{$trans->subBudgetCategory->name}}</p>
            @else
                <p>{{$trans->budgetCategory->balance->name}}: {{$trans->budgetCategory->name}}</p>
            @endif
            <p>{{$trans->description}}</p>
            <p>{{ date('D, M. d @ h:ia', strtotime($trans->date_made) ) }}</p>
            <p>{{$trans->transactionType->name}}: ${{$trans->amount}} ({{$trans->paymentType->name}})</p>
            <p><a href="{{route('transactions.edit', compact('trans'))}}">Edit</a></p>
            <div>
                <form method="post" action="{{route('transactions.destroy', compact('trans'))}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </div>
        </div>
        <hr>
    @endforeach
@endsection
