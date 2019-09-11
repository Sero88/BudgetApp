@extends('layouts.app')
@section('title', $budgetCategory->name)

@section('content')
	@include('budget_categories.actuals-vs-budget')
	@include('budget_categories.budget-transactions')

    <a href="<?= route('budget-categories.edit',['id' => $budgetCategory->id])?>">Edit</a>

@endsection
