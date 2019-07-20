@extends('layouts.app')

@section('title', 'Create New Balance')

@section('content')

    @component('components.message')
        {{ session('message') }}
    @endcomponent

    @include('balances.form')

@endsection