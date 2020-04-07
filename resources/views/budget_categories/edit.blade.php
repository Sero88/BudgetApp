@extends('layouts.app')
@section('title', 'Edit Balance')

@section('content')
<form action="<?=route( 'budget-categories.update', compact('balance', 'budgetCategory') )?>" method="post">
    @method('PATCH')
    @include('budget_categories.form')
    @csrf
    <input type="submit" value="Save">
</form>

<form action="<?=route( 'budget-categories.destroy', compact('balance', 'budgetCategory') )?>" method="post">
    @csrf
    @method('DELETE')
    <input type="submit" class="delete-button" value="Delete">
</form>
<?php //dd($errors->all()); ?>
@endsection
