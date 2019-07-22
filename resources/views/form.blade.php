@if(session('message'))
    <div>{{session('message')}}</div>
@endif



<div>
    <label for="#trans-amount">Amount</label><br>
    <input id="trans-amount" type="number" name="amount" min="0.01" step="0.01" value="<?=$transaction->amount?>" required>
</div>

<div>
    <label for="type_id">Type</label><br>
    <select id="type_id" name="type_id">
        @foreach($types as $type)
            <?php  $selected = $transaction->type_id == $type->id ? ' selected' : ''; ?>
            <option value="{{$type->id}}"<?=$selected?>>{{$type->name}}</option>
        @endforeach()
    </select>
</div>

<div>
    <label for="budget_cat_id">Category</label><br>
    <select id="budget_cat_id" name="budget_cat_id">
        @foreach($cats as $cat)
            <?php $selected = $transaction->budget_cat_id == $cat->id ? ' selected' : '';?>
            <option value="{{$cat->id}}"<?=$selected?>>{{$cat->name}}</option>
        @endforeach()
    </select>
</div>

<?php print_r($errors->all()); ?>

<button type="submit">Submit</button>