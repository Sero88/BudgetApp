@extends('layouts.app')
<div>
    @section('title', 'Settings')
</div>


@section('content')
    <div class="section-block">
        <h2>Payment Types</h2>
        <a href="{{route('payment-types.index')}}">View all</a>
    </div>
    <hr>
@endsection
