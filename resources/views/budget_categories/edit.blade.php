@extends('layouts.app')
@section('title', 'Edit Balance')

@section('content')
<form action="/budget-categories/{{$budgetCategory->id}}" method="post">
    @method('PATCH')
    @include('budget_categories.form')
    @csrf
    <input type="submit" value="Save">
</form>
<?php //dd($errors->all()); ?>
@endsection
