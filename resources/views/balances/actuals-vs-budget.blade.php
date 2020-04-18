<?php

$month_total = $balance->monthlyTransactions('expense')->sum('amount');

$budget_total = $balance->balanceBudget();

?>
<span class="<?= $month_total > $budget_total ? 'amount-over' : 'amount-under'?>">{{$month_total}}</span> / {{$budget_total}}

