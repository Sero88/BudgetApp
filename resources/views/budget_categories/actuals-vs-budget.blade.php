<?php
$month_total = $budgetCategory->monthlyTransactions('credit')->sum('amount');
?>
<span class="<?= $month_total > $budgetCategory->budget() ? 'amount-over' : 'amount-under'?>">{{$month_total}}<span> / {{$budgetCategory->budget()}} ({{$budgetCategory->getExpensePercentage()}})

