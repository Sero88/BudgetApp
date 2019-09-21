<ul>
@foreach($budget_category->monthlyTransactions()->get()->sortBy('date_made') as $transaction)
	<?php //<li>{{date('D, M. d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} @if($transaction->description) &ndash; ({{$transaction->description}})@endif</li> ?>
    <li>{{transaction_details($transaction)}}</li>
@endforeach
</ul>
