@extends('layouts.app')
@section('title', $budgetCategory->name)

@section('content')

    @include('budget_categories.actuals-vs-budget')

    @if(!empty($budgetCategory->description))
        <p>{{$budgetCategory->description}}</p>
    @endif

    <div>
         @if($budgetCategory->subBudgetCategories->isNotEmpty())
            <h3>List of Subcategories</h3>
            <ul>
                @foreach($budgetCategory->subBudgetCategories as $subBudgetCategory)
                    <li><a href="{{route('sub-budget-categories.show', compact('balance', 'budgetCategory', 'subBudgetCategory'))}}">{{$subBudgetCategory->name}}</a> @include('sub_budget_categories.actuals-vs-budget') <a href="{{route('sub-budget-categories.edit', compact('balance','budgetCategory','subBudgetCategory'))}}">Edit</a></li>
                @endforeach
            </ul>
        @endif
        <a href="{{route('sub-budget-categories.create', compact('balance', 'budgetCategory'))}}">+ New SubCategory</a>
    </div>



	@include('transactions.list', ['object' => $budgetCategory])

    <a href="<?= route( 'budget-categories.edit', compact('balance', 'budgetCategory') )?>">Edit</a>





@endsection
