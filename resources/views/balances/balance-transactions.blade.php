<h2>Transactions</h2>
@foreach($balance->monthly_transactions()->get()->sortBy('date_made') as $transaction)
		<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budget_category()->first()->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li>
@endforeach
</ul>