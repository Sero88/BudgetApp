<h2>Transactions</h2>
@foreach($balance->monthlyTransactions()->get()->sortBy('date_made') as $transaction)
		<?php //<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budget_category->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li> ?>
        <li>{{transaction_details($transaction, true)}}</li>
@endforeach
</ul>
