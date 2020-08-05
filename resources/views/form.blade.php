@if(session('message'))
    <div>{{session('message')}}</div>
@endif

<div class="form-header">
    <p>Account Balance: <a href="{{route('balances.show', compact('balance'))}}">${{$balance->amount}}</a></p>
    <p>Monthly Budget: {{$balance->monthlyTransactions('credit')->sum('amount')}}/{{$balance->balanceBudget()}} ({{$balance->getExpensePercentage()}})</p>
</div>

@php
/*
Version 2 will allow multiple balances
<div>
    <label for="#trans-balance">Balance</label><br>
    <select id="trans-balance" name="balance_id">
        @foreach($balances as $balance)
            <?php $balanceSelected = $transaction->budget_cat_id == $cat->id ? ' selected' : '';?>
            <option value="{{ $balance->id }}"{{$balanceSelected}}>{{ $balance->name }}</option>
        @endforeach
    </select>
</div>
*/
@endphp


<div class="form-section">
    <label for="#trans-amount">Amount</label><br>
    <input id="trans-amount" class="amount" placeholder="$0" type="number" name="amount" min="0.01" step="0.01" value="<?=$transaction->amount?>" required>
</div>

<div class="form-section">
    <label for="type_id">Type</label><br>
    <select id="type_id" name="type_id">
        @foreach($transactionTypes as $type)
            <?php  $typeSelected = $transaction->type_id == $type->id ? ' selected' : ''; ?>
            <option value="{{$type->id}}"{{$typeSelected}}>{{$type->name}}</option>
        @endforeach()
    </select>
</div>

<div class="categories-container">
    <div class="main-categories form-section">
        <label for="budget_cat_id">Category</label><br>
        <select id="budget_cat_id" name="budget_cat_id">
            @foreach($cats as $cat)
                <?php $catSelected = $transaction->budget_cat_id == $cat->id ? ' selected' : '';?>
                <option value="{{$cat->id}}"{{$catSelected}}>{{$cat->name}}</option>
            @endforeach()
        </select>        
    </div>
</div>


<div id="sub-categories" class="sub-categories-container form-section">
    <data id="selected-sub-category" value="{{$subBudgetCategoryId}}"></data>
</div>

<div class="form-section">
    <label for="payment_type">Payment Type</label><br>
    <select id="payment_type" name="payment_type_id">
        @foreach($paymentTypes as $paymentType)
            <?php $paymentTypeSelected = $transaction->payment_type_id == $paymentType->id ? ' selected' : '';?>
            <option value="{{$paymentType->id}}"{{$paymentTypeSelected}}>{{$paymentType->name}}</option>
        @endforeach()
    </select>
</div>


<div class="form-section">
    <label for="date_made">Date</label><br>
    <input id="date_made" class="datepicker" readonly type="text" name="date_made" value="<?=$transaction->date_made?>" required>
</div>

<div class="form-section">
    <label for="description">Description</label><br>
    <textarea name="description">{{$transaction->description}}</textarea>
</div>



