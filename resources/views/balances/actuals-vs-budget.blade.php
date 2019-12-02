<?php

$month_total = $balance->monthlyTransactions('credit')->sum('amount');

$budget_total = $balance->budgetCategories->sum('budget');

?>
<span class="<?= $month_total > $budget_total ? 'amount-over' : 'amount-under'?>">{{$month_total}}<span> / {{$budget_total}}

