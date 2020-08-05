@extends('layouts.app')

@section('title', 'New Transaction')

@section('content')
    @if( $errors->any())
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
        <form class="form-budget" method="POST" action="/transactions">
            @include('form')
            @csrf
            <button class="btn" type="submit">Make Transaction</button>
        </form>
@endsection
