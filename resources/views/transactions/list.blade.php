<h2>{{Carbon\Carbon::now()->monthName}} Transactions</h2>
<h3>Expense: ${{$object->monthlyTransactions('expense')->sum('amount')}}</h3>
<ul>
@forelse($object->monthlyTransactions('expense')->get()->sortByDesc('date_made') as $transaction)
    <?php //<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budgetCategory->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li> ?>
    <li>{{monthly_transaction_details($transaction, true)}}</li>
@empty
    <li>No Expense transactions.</li>
@endforelse
</ul>


<h3>Income: ${{$object->monthlyTransactions('income')->sum('amount')}}</h3>
<ul>
@forelse($object->monthlyTransactions('income')->get()->sortByDesc('date_made') as $transaction)
    <?php //<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budgetCategory->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li> ?>
    <li>{{monthly_transaction_details($transaction, true)}}</li>
@empty
    <li>No Income transactions.</li>
    @endforelse
</ul>
