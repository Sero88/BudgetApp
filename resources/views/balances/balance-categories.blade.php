
<h2>Budget Categories</h2>
<ul>
@foreach($balance->budget_categories()->get() as $cat)
	<?php
		//get cat transaction sum
		$cat_sum = $cat->monthlyTransactions()->get()->sum('amount')
	?>
	<li>{{$cat->name}} <span class="<?= $cat_sum > $cat->budget ?'amount-over':'amount-under'?>">($<?=number_format($cat_sum, 2)?></span> / ${{$cat->budget}})</li>
@endforeach
</ul>