@extends('layouts.app')

@section('content')
    <form action="/transactions/{{$transaction->id}}" method="post">
        @csrf
        @method('PATCH')
        @include('form')
    </form>
@endsection