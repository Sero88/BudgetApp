<?php
$month_total = $budget_category->monthlyTransactions('credit')->sum('amount');
?>
<span class="<?= $month_total > $budget_category->budget ? 'amount-over' : 'amount-under'?>">{{$month_total}}<span> / {{$budget_category->budget}}
