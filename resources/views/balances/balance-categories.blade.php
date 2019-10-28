
<h2>Budget Categories</h2>
<ul>
@foreach($balance->budget_categories->sortBy('name') as $budget_category)
	<?php
		//get cat transaction sum
		$budget_category_sum = $budget_category->monthlyTransactions('credit')->sum('amount');

	?>
    <li><a href="<?=route( 'budget-categories.show', compact('balance', 'budget_category') )?>">{{$budget_category->name}}</a> <span class="<?= $budget_category_sum > $budget_category->budget ?'amount-over':'amount-under'?>">($<?=number_format($budget_category_sum, 2)?></span> / ${{$budget_category->budget}})</li>
@endforeach
</ul>
<a href="<?=route( 'budget-categories.create', compact('balance') )?>">New Budget Category</a>
