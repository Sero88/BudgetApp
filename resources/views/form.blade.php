@if(session('message'))
    <div>{{session('message')}}</div>
@endif



<div>
    <label for="#trans-amount">Amount</label><br>
    <?php
    //todo wondering if this can be refactored
    $amount = '';
    if(!empty( old('amount') ) ) {
        $amount = old('amount');
    } elseif( !empty($transaction->amount) ){
        $amount = $transaction->amount;
    }
    ?>
    <input id="trans-amount" type="number" name="amount" min="0.01" step="0.01" value="<?=$amount?>" required>
</div>

<div>
    <label for="type_id">Type</label><br>
    <select id="type_id" name="type_id">
        @foreach($types as $type)
            <?php
            //todo wondering if this can be refactored
                $old_type = '';
                if(!empty( old('type_id') ) ) {
                    $old_type = old('type_id');
                } elseif( !empty($transaction->type_id) ){
                    $old_type = $transaction->type_id;
                }

                $selected = $old_type == $type->id ? ' selected' : '';
            ?>
            <option value="{{$type->id}}"<?=$selected?>>{{$type->name}}</option>
        @endforeach()
    </select>
</div>

<div>
    <label for="budget_cat_id">Category</label><br>
    <select id="budget_cat_id" name="budget_cat_id">
        @foreach($cats as $cat)
            <?php
            //todo wondering if this can be refactored
            $old_cat = '';
            if(!empty( old('budget_cat_id') ) ) {
                $old_cat= old('budget_cat_id');
            } elseif( !empty($transaction->budget_cat_id) ){
                $old_cat = $transaction->budget_cat_id;
            }

            $selected = $old_cat == $cat->id ? ' selected' : '';
            ?>
            <option value="{{$cat->id}}"<?=$selected?>>{{$cat->name}}</option>
        @endforeach()
    </select>
</div>

<?php print_r($errors->all()); ?>

<button type="submit">Submit</button>
