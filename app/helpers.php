<?php

function get_old_trans_data($transaction){
    $transaction->amount = !empty(old('amount')) ? old('amount') : $transaction->amount;
    $transaction->type_id = !empty(old('type_id')) ? old('type_id') : $transaction->type_id;
    $transaction->budget_cat_id = !empty(old('budget_cat_id')) ? old('budget_cat_id') : $transaction->budget_cat_id;
    $transaction->description = !empty(old('description')) ? old('description') : '';
    return $transaction;
}
