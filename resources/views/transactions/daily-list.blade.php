<h2>{{Carbon\Carbon::now()->format('M d, Y')}} Transactions</h2>

<div class="trans-type-block">
    <h3>Expense: ${{$object->dailyTransactions('expense')->sum('amount')}}</h3>
    <ul>
        @forelse($object->dailyTransactions('expense')->get()->sortByDesc('date_made') as $transaction)
            <?php //<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budgetCategory->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li> ?>
            <li>{{daily_transaction_details($transaction, true)}}</li>
        @empty
            <li>No Expense transactions.</li>
        @endforelse
    </ul>
</div>


<div class="trans-type-block">
    <h3>Income: ${{$object->dailyTransactions('income')->sum('amount')}}</h3>
    <ul>
    @forelse($object->dailyTransactions('income')->get()->sortByDesc('date_made') as $transaction)
        <?php //<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budgetCategory->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li> ?>
        <li>{{daily_transaction_details($transaction, true)}}</li>
    @empty
        <li>No Income transactions.</li>
        @endforelse
    </ul>
</div>
