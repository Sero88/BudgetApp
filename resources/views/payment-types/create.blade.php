@extends('layouts.app')

@section('title', 'Payment Type')

@section('content')

    @component('components.message')
        {{ session('message') }}
    @endcomponent

    <form action="<?=route( 'payment-types.store' )?>" method="post" >
        @csrf
        @include('payment-types.form')
        <input type="submit" value="Save">
    </form>


    @if( $errors->any())
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
@endsection
