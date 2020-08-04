
<h2>Budget Categories</h2>
<ul>
@foreach($balance->budgetCategories->sortBy('name') as $budgetCategory)
	<?php
		//get cat transaction sum
		$budgetCategory_sum = $budgetCategory->monthlyTransactions('credit')->sum('amount');

	?>
    <li><a href="<?=route( 'budget-categories.show', compact('balance', 'budgetCategory') )?>">{{$budgetCategory->name}}</a> <span class="<?= $budgetCategory_sum > $budgetCategory->budget() ?'amount-over':'amount-under'?>">($<?=number_format($budgetCategory_sum, 2)?></span> / ${{$budgetCategory->budget()}}) {{$budgetCategory->getExpensePercentage()}}</li>
@endforeach
</ul>
<a href="<?=route( 'budget-categories.create', compact('balance') )?>">+ New Budget Category</a>
