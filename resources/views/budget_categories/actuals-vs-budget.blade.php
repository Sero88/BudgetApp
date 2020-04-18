<?php
$month_total = $budgetCategory->monthlyTransactions('expense')->sum('amount');
?>
<span class="<?= $month_total > $budgetCategory->budget() ? 'amount-over' : 'amount-under'?>">{{$month_total}}</span> / {{$budgetCategory->budget()}} ({{$budgetCategory->getExpensePercentage()}})

