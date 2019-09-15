<?php
$month_total = $budget_category->monthly_transactions('credit')->sum('amount');
?>
<span class="<?= $month_total > $budget_category->budget ? 'amount-over' : 'amount-under'?>">{{$month_total}}<span> / {{$budget_category->budget}}
