@extends('layouts.app')
@section('title', $budgetCategory->name)

@section('content')
    @if(!empty($budgetCategory->description))
        <p>{{$budgetCategory->description}}</p>
    @endif

	@include('budget_categories.actuals-vs-budget')
	@include('transactions.list', ['object' => $budgetCategory])


    <a href="<?= route( 'budget-categories.edit', compact('balance', 'budgetCategory') )?>">Edit</a>

@endsection
