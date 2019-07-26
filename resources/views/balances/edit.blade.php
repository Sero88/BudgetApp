@extends('layouts.app')
@section('title', 'Edit Balance')

@section('content')
<form action="/balances/{{$balance->id}}" method="post">
    @method('PATCH')
    @include('balances.form')
</form>

@endsection
