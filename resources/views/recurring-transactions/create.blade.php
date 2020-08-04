@extends('layouts.app')

@section('title', 'New Recurring Transaction')

@section('content')

    @component('components.message')
        {{ session('message') }}
    @endcomponent

    <form action="<?=route( 'recurring-transactions.store' )?>" method="post" >
        @csrf
        @include('recurring-transactions.form')
        <input type="submit" value="Save">
    </form>


    @if( $errors->any())
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
@endsection
