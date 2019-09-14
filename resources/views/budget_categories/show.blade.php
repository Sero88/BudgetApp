@extends('layouts.app')
@section('title', $budgetCategory->name)

@section('content')
    <p>{{$budgetCategory->description}}</p>

	@include('budget_categories.actuals-vs-budget')
	@include('budget_categories.budget-transactions')

    @if(!empty($budgetCategory->description))

    @endif
    <a href="<?= route('budget-categories.edit',['budget_category' => $budgetCategory->id, 'balance' => $budgetCategory->balance->id])?>">Edit</a>

@endsection
