<?php

$month_total = $balance->monthly_transactions('credit')->sum('amount');

$budget_total = $balance->budget_categories()->sum('budget');

?>
<span class="<?= $month_total > $budget_total ? 'amount-over' : 'amount-under'?>">{{$month_total}}<span> / {{$budget_total}}

