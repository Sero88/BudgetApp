@extends('layouts.app')
@section('title', 'Edit Transaction')
@section('content')
    <form action="{{route('transactions.update', compact('transaction'))}}" method="post">
        @csrf
        @method('PATCH')
        @include('form')
        <button type="submit">Submit</button>
    </form>
@endsection
