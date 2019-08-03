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
            <p>{{ date('m-d-Y', strtotime($trans->date_made) ) }}</p>
            <p>{{$trans->transaction_type->name}}: {{$trans->amount}}</p>
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