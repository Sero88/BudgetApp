<h2>{{Carbon\Carbon::now()->format('M d, Y')}} Transactions</h2>

<div class="trans-type-block">
    <h3>Credit: ${{$object->dailyTransactions('credit')->sum('amount')}}</h3>
    <ul>
        @forelse($object->dailyTransactions('credit')->get()->sortByDesc('date_made') as $transaction)
            <?php //<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budgetCategory->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li> ?>
            <li>{{daily_transaction_details($transaction, true)}}</li>
        @empty
            <li>No Credit transactions.</li>
        @endforelse
    </ul>
</div>


<div class="trans-type-block">
    <h3>Debit: ${{$object->dailyTransactions('debit')->sum('amount')}}</h3>
    <ul>
    @forelse($object->dailyTransactions('debit')->get()->sortByDesc('date_made') as $transaction)
        <?php //<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budgetCategory->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li> ?>
        <li>{{daily_transaction_details($transaction, true)}}</li>
    @empty
        <li>No Debit transactions.</li>
        @endforelse
    </ul>
</div>
