@if(session('message'))
    <div>{{session('message')}}</div>
@endif

<div>
    <a href="{{route('balances.show', compact('balance'))}}">{{$balance->amount}}</a>
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
<div>
    <label for="#trans-amount">Amount</label><br>
    <input id="trans-amount" type="number" name="amount" min="0.01" step="0.01" value="<?=$transaction->amount?>" required>
</div>

<div>
    <label for="type_id">Type</label><br>
    <select id="type_id" name="type_id">
        @foreach($types as $type)
            <?php  $typeSelected = $transaction->type_id == $type->id ? ' selected' : ''; ?>
            <option value="{{$type->id}}"{{$typeSelected}}>{{$type->name}}</option>
        @endforeach()
    </select>
</div>

<div>
    <label for="budget_cat_id">Category</label><br>
    <select id="budget_cat_id" name="budget_cat_id">
        @foreach($cats as $cat)
            <?php $catSelected = $transaction->budget_cat_id == $cat->id ? ' selected' : '';?>
            <option value="{{$cat->id}}"{{$catSelected}}>{{$cat->name}}</option>
        @endforeach()
    </select>
</div>

<div>
    <label for="description">Description</label><br>
    <textarea name="description">{{$transaction->description}}</textarea>
</div>



