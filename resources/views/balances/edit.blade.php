@extends('layouts.app')
@section('title', 'Edit Balance')

@section('content')
<form action="{{route('balances.update', compact('balance'))}}" method="post">
    @method('PATCH')
    @include('balances.form')
    <input type="submit" value="Save Changes">
</form>

@endsection
