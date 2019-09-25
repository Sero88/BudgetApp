@extends('layouts.app')
@section('title', $budget_category->name)

@section('content')
    <p>{{$budget_category->description}}</p>

	@include('budget_categories.actuals-vs-budget')
	@include('transactions.list', ['object' => $budget_category])

    @if(!empty($budget_category->description))

    @endif
    <a href="<?= route( 'budget-categories.edit', compact('balance', 'budget_category') )?>">Edit</a>

@endsection
