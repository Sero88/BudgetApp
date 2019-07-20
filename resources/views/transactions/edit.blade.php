@extends('layouts.app')
@section('title', 'Edit Transaction')
@section('content')
    <form action="/transactions/{{$transaction->id}}" method="post">
        @csrf
        @method('PATCH')
        @include('form')
    </form>
@endsection