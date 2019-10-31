@extends('layouts.app')
@section('title', 'Edit Recurring Transaction')
@section('content')
    <form action="{{route('payment-types.update',compact('paymentType'))}}" method="post">
        @csrf
        @method('PATCH')
        @include('payment-types.form')
        <button type="submit">Submit</button>
    </form>
@endsection
