@if(session('message'))
    <div>{{session('message')}}</div>
@endif


<div>
    <label for="trans-name">Name</label><br>
    <input id="trans-name" type="text" name="name" value="<?=$recurringTransaction->name?>" required>
</div>

<div>
    <label for="trans-amount">Amount</label><br>
    <input id="trans-amount" type="number" name="amount" min="0.01" step="0.01" value="<?=$recurringTransaction->amount?>" required>
</div>

<div>
    <label for="type_id">Type</label><br>
    <select id="type_id" name="transaction_type">
        @foreach($types as $type)
            <?php  $selected = $recurringTransaction->transaction_type == $type->id ? ' selected' : ''; ?>
            <option value="{{$type->id}}"<?=$selected?>>{{$type->name}}</option>
        @endforeach()
    </select>
</div>


<div class="categories-container">
    <div class="main-categories">
        <label for="budget_cat_id">Category</label><br>
        <select id="budget_cat_id" name="budget_cat_id">
            @foreach($cats as $cat)
                <?php $catSelected = $recurringTransaction->budget_cat_id == $cat->id ? ' selected' : '';?>
                <option value="{{$cat->id}}"{{$catSelected}}>{{$cat->name}}</option>
            @endforeach()
        </select>
        <data id="selected-sub-category" value="{{$subBudgetCategoryId}}"></data>


    </div>
</div>

<div>
    <label for="payment_type_id">Payment Type</label><br>
    <select id="payment_type_id" name="payment_type_id">
        @foreach($paymentTypes as $paymentType)
            <?php $paymentTypeSelected = $recurringTransaction->payment_type_id == $paymentType->id ? ' selected' : '';?>
            <option value="{{$paymentType->id}}"<?=$paymentTypeSelected?>>{{$paymentType->name}}</option>
        @endforeach()
    </select>
</div>

<div>
    <label for="day_of_month">Begin Date</label><br>
    <input id="day_of_month" class="datepicker-after-today" readonly type="text" name="day_of_month" value="<?=$recurringTransaction->day_of_month?>" required>
</div>

<div>
    <label for="interval">Interval</label><br>
    <select id="interval" name="interval_id">
        @foreach($intervals as $interval)
            <?php $selected = $recurringTransaction->interval_id == $interval->id ? ' selected' : '';?>
            <option value="{{$interval->id}}"{{$selected}}>{{$interval->name}}</option>
        @endforeach()
    </select></div>

<div>
    <label for="description">Description</label><br>
    <textarea name="description">{{$recurringTransaction->description}}</textarea>
</div>

