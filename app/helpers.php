<?php

function get_old_trans_data($transaction){
    $transaction->amount = !empty(old('amount')) ? old('amount') : $transaction->amount;
    $transaction->type_id = !empty(old('type_id')) ? old('type_id') : $transaction->type_id;
    $transaction->budget_cat_id = !empty(old('budget_cat_id')) ? old('budget_cat_id') : $transaction->budget_cat_id;
    $transaction->description = !empty(old('description')) ? old('description') : $transaction->description;
    return $transaction;
}

function get_old_balance_data($balance){
    $balance->name = !empty(old('name')) ? old('name') : '';
    $balance->description = !empty(old('description')) ? old('description') : '';
    $balance->amount = !empty(old('amount')) ? old('amount') : '';
    $balance->owner_id = !empty(old('owner_id')) ? old('ownder_id') : '';
    return $balance;
}

function get_old_recurring_trans_data($recurringTransaction){
    $recurringTransaction->name = !empty(old('name')) ? old('name') : $recurringTransaction->name;
    $recurringTransaction->amount = !empty(old('amount')) ? old('amount') : $recurringTransaction->amount;
    $recurringTransaction->type_id = !empty(old('type_id')) ? old('type_id') : $recurringTransaction->type_id;
    $recurringTransaction->interval_id = !empty(old('interval_id')) ? old('interval_id') : $recurringTransaction->interval_id;
    $recurringTransaction->budget_cat_id = !empty(old('budget_cat_id')) ? old('budget_cat_id') : $recurringTransaction->budget_cat_id;
    $recurringTransaction->description = !empty(old('description')) ? old('description') : $recurringTransaction->description;
    $recurringTransaction->day_of_month = !empty(old('day_of_month')) ? old('day_of_month') : $recurringTransaction->day_of_month;
    return $recurringTransaction;
}

function get_old_budget_data($budgetCategory){
    $budgetCategory->name = !empty( old('budget_cat') ) ? $budget_cat[0] : $budgetCategory->name;
    $budgetCategory->description = !empty( old('budget_cat_description') ) ? $budget_cat_description[0] : $budgetCategory->description;
    $budgetCategory->budget = !empty( old('budget_cat_amount') ) ? $budget_cat_amount[0] : $budgetCategory->budget;
}

function transaction_details($transaction, $cat = false){
    $date_section = date('D, M. d \a\t g:ia', strtotime($transaction->date_made) );
    $amount_section =  $transaction->amount; //get_trans_amount($transaction, '$');
    $description = !empty($transaction->description) ? ' - ' . $transaction->description : '';

    $cat_name = $cat == true ? $transaction->budget_category->name : '';

    return "$date_section: $$amount_section ({$cat_name}$description)";
}

function get_trans_amount($transaction, $currency_symbol = false){
    $amount = $transaction->transaction_type->name == 'credit' ? $transaction->amount * -1 : $transaction->amount;

    //add money format with currency symbol
    if($currency_symbol){
        setlocale(LC_MONETARY, 'en_US.UTF-8');
        $amount = money_format('%.2n', $amount);
    }

    return $amount;

}


