@extends('layouts.app')

@section('title', 'Create New Balance')

@section('content')

    @component('components.message')
        {{ session('message') }}
    @endcomponent

    <form action="/balances" method="post" >
        @include('balances.form')
        <input type="submit">
    </form>
@endsection
