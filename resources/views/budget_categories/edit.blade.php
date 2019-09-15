@extends('layouts.app')
@section('title', 'Edit Balance')

@section('content')
<form action="<?=route( 'budget-categories.update', compact('balance', 'budget_category') )?>" method="post">
    @method('PATCH')
    @include('budget_categories.form')
    @csrf
    <input type="submit" value="Save">
</form>

<form action="<?=route( 'budget-categories.destroy', compact('balance', 'budget_category') )?>" method="post">
    @csrf
    @method('DELETE')
    <input type="submit" value="Delete">
</form>
<?php //dd($errors->all()); ?>
@endsection
