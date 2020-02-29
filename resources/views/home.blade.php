@extends('layouts.app')

@section('title', 'New Transaction')

@section('content')
    @if( $errors->any())
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
        <form method="POST" action="/transactions">
            @include('form')
            @csrf
            <button type="submit">Make Transaction</button>
        </form>


@endsection
