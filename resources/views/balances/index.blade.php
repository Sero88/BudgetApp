@extends('layouts.app')

@section('title', 'Balances')

@section('content')
    @if(session('message'))
        <div>
            {{session('message')}}
            <hr>
        </div>
    @endif

    @foreach($balances as $balance)

        <div class="transaction-block">
            <p>{{$balance->name}}: ${{number_format($balance->amount, 2)}}</p>
            <p><a href="/balances/{{$balance->id}}/edit">Edit</a></p>
            <div>
                <form method="post" action="/balances/{{$balance->id}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        </div>
        <hr>
    @endforeach
@endsection