@extends('layouts.app')

@section('title', 'Create New Budget Subcategory')

@section('content')

    @component('components.message')
        {{ session('message') }}
    @endcomponent

    <form action="<?=route( 'sub-budget-categories.store', compact('balance', 'budgetCategory') )?>" method="post" >
        @csrf
        @include('sub_budget_categories.form')
        <input type="submit" value="Save Category">
    </form>

    @if($errors->any())
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach

    @endif
@endsection
