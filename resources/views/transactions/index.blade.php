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
            <p>{{$trans->budget_category->balance->name}}: {{$trans->budget_category->name}}</p>
            <p>{{$trans->description}}</p>
            <p>{{ date('D, M. d @ h:ia', strtotime($trans->date_made) ) }}</p>
            <p>{{$trans->transaction_type->name}}: {{$trans->amount}}</p>
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
