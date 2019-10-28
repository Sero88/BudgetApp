@extends('layouts.app')

@section('title', 'Create New Budget Category')

@section('content')

    @component('components.message')
        {{ session('message') }}
    @endcomponent

    <form action="<?=route( 'budget-categories.store', compact('balance') )?>" method="post" >
        @csrf
        @include('budget_categories.form')
        <input type="submit" value="Save Category">
    </form>

    @if($errors->any())
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach

    @endif
@endsection
