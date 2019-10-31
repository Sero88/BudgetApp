<h2>{{Carbon\Carbon::now()->monthName}} Transactions</h2>
<h3>Credit</h3>
<ul>
@forelse($object->monthlyTransactions('credit')->get()->sortByDesc('date_made') as $transaction)
    <?php //<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budget_category->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li> ?>
    <li>{{transaction_details($transaction, true)}}</li>
@empty
    <li>No Credit transactions.</li>
@endforelse
</ul>


<h3>Debit</h3>
<ul>
@forelse($object->monthlyTransactions('debit')->get()->sortByDesc('date_made') as $transaction)
    <?php //<li>{{date('F d \a\t g:ia', strtotime($transaction->date_made) )}}: ${{$transaction->amount}} ({{$transaction->budget_category->name}}@if($transaction->description) &ndash; {{$transaction->description}}@endif)</li> ?>
    <li>{{transaction_details($transaction, true)}}</li>
@empty
    <li>No Debit transactions.</li>
    @endforelse
</ul>
