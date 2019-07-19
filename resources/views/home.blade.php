@extends('layouts.app')

@section('title', 'New Transaction')

@section('content')
        <form method="POST" action="/transactions">
            @include('form')
            @csrf
        </form>
@endsection