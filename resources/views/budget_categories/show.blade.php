@extends('layouts.app')
@section('title', $budget_category->name)

@section('content')
    @if(!empty($budget_category->description))
        <p>{{$budget_category->description}}</p>
    @endif

	@include('budget_categories.actuals-vs-budget')
	@include('transactions.list', ['object' => $budget_category])


    <a href="<?= route( 'budget-categories.edit', compact('balance', 'budget_category') )?>">Edit</a>

@endsection
