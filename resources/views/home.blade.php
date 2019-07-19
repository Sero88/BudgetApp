@extends('layouts.app')

@section('title', 'New Transaction')

@section('content')
        @if(session('message'))
            <div>{{session('message')}}</div>
        @endif
        <form method="POST" action="/transactions">
            @component('form',['types' => $types, 'cats' => $cats])@endcomponent
        </form>
@endsection