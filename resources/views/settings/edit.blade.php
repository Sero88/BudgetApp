@extends('layouts.app')
@section('title', 'Edit Recurring Transaction')
@section('content')
    <form action="{{route('recurring-transactions.update',compact('recurringTransaction'))}}" method="post">
        @csrf
        @method('PATCH')
        @include('recurring-transactions.form')
        <button type="submit">Submit</button>
    </form>
@endsection
