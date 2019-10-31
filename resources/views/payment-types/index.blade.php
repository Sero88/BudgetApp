@extends('layouts.app')
<div>
    @section('title', 'Payment Types')
</div>


@section('content')
    @if(session('message'))
        <div>
            {{session('message')}}
            <hr>
        </div>
    @endif
    <div>
        <a href="{{route('payment-types.create')}}">+ New Payment Type</a>
    </div>
    <hr>
    @foreach($paymentTypes as $paymentType)


        <div class="transaction-block">
            <h2>{{$paymentType->name}}</h2>
            <p>{{$paymentType->description}}</p>
            <p><a href="{{ route('payment-types.edit', compact('paymentType') ) }}">Edit</a></p>
            <div>
                <form method="post" action="{{ route('payment-types.destroy', compact('paymentType') ) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </div>
        </div>
        <hr>
    @endforeach
@endsection
