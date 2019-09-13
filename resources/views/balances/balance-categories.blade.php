
<h2>Budget Categories</h2>
<ul>
@foreach($balance->budget_categories()->get() as $cat)
	<?php
		//get cat transaction sum
		$cat_sum = $cat->monthly_transactions('credit')->sum('amount');
	?>
		<li><a href="/budget-categories/{{$cat->id}}">{{$cat->name}}</a> <span class="<?= $cat_sum > $cat->budget ?'amount-over':'amount-under'?>">($<?=number_format($cat_sum, 2)?></span> / ${{$cat->budget}})</li>
@endforeach
</ul>