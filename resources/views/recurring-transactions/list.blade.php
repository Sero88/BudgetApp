<h2>Transactions</h2>
<h3>Expense</h3>
<ul>
@forelse($object->monthlyTransactions('expense')->get()->sortBy('date_made') as $transaction)
    <?php //<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budgetCategory->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li> ?>
    <li>{{transaction_details($transaction, true)}}</li>
@empty
    <li>No Expense transactions.</li>
@endforelse
</ul>


<h3>Income</h3>
<ul>
@forelse($object->monthlyTransactions('income')->get()->sortBy('date_made') as $transaction)
    <?php //<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budgetCategory->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li> ?>
    <li>{{transaction_details($transaction, true)}}</li>
@empty
    <li>No Income transactions.</li>
    @endforelse
</ul>
