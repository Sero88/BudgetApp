<?php

function get_old_trans_data($transaction){
    $transaction->amount = !empty(old('amount')) ? old('amount') : $transaction->amount;
    $transaction->type_id = !empty(old('type_id')) ? old('type_id') : $transaction->type_id;
    $transaction->budget_cat_id = !empty(old('budget_cat_id')) ? old('budget_cat_id') : $transaction->budget_cat_id;
    $transaction->description = !empty(old('description')) ? old('description') : '';
    return $transaction;
}

function get_old_budget_data($budgetCategory){
    $budgetCategory->name = !empty( old('budget_cat') ) ? $budget_cat[0] : $budgetCategory->name;
    $budgetCategory->description = !empty( old('budget_cat_description') ) ? $budget_cat_description[0] : $budgetCategory->description;
    $budgetCategory->budget = !empty( old('budget_cat_amount') ) ? $budget_cat_amount[0] : $budgetCategory->budget;
}


