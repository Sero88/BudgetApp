@extends('layouts.app')
@section('title', $budgetCategory->name)

@section('content')
    @if(!empty($subBudgetCategory->description))
        <p>{{$subBudgetCategory->description}}</p>
    @endif

	@include('sub_budget_categories.actuals-vs-budget')
	@include('transactions.list', ['object' => $subBudgetCategory])

    <a href="{{route('sub-budget-categories.edit', compact('balance','budgetCategory','subBudgetCategory'))}}">Edit</a>

@endsection
