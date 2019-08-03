<ul>
@foreach($budgetCategory->monthly_transactions()->get()->sortBy('date_made') as $transaction)
	<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} @if($transaction->description) &ndash; ({{$transaction->description}})@endif</li>
@endforeach
</ul>
