@extends('layouts.app')

@section('title', 'Create New Budget Category')

@section('content')

    @component('components.message')
        {{ session('message') }}
    @endcomponent

    <form action="<?=route('budget-categories.store',['balance' => $balance->id])?>" method="post" >
        @csrf
        @include('budget_categories.form')
        <input type="submit">
    </form>
@endsection
