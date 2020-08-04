<?php
$month_total = $subBudgetCategory->monthlyTransactions('credit')->sum('amount');
?>
<span class="<?= $month_total > $subBudgetCategory->budget ? 'amount-over' : 'amount-under'?>">{{$month_total}}</span> / {{$subBudgetCategory->budget}} ({{$subBudgetCategory->getExpensePercentage()}})

