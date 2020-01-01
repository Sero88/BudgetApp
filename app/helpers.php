<?php

use Carbon\Carbon;

function get_old_trans_data($transaction){
    $transaction->amount = old('amount') ?? $transaction->amount;
    $transaction->type_id =  old('type_id') ?? $transaction->type_id;
    $transaction->budget_cat_id =  old('budget_cat_id') ?? $transaction->budget_cat_id;
    $transaction->description = old('description') ?? $transaction->description;
    $transaction->payment_type_id = old('payment_type_id') ?? $transaction->payment_type_id;
    $transaction->date_made = old('date_made') ? $transaction->date_made : Carbon::now()->format('m/d/Y');

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
    $budgetCategory->name = !empty( old('budget_cat')[0] ) ? old('budget_cat')[0] : $budgetCategory->name;
    $budgetCategory->description = !empty( old('budget_cat_description')[0] ) ? old('budget_cat_description')[0] : $budgetCategory->description;
    $budgetCategory->budget = !empty( old('budget_cat_amount')[0] ) ? old('budget_cat_amount')[0] : $budgetCategory->budget;

    return $budgetCategory;
}

function monthly_transaction_details($transaction){
    $date_section = date('D, M. d', strtotime($transaction->date_made) );
    $amount_section =  $transaction->amount; //get_trans_amount($transaction, '$');
    $description = !empty($transaction->description) ? ' - ' . $transaction->description : '';

    $cat_name =  $transaction->budgetCategory->name;

    return "$date_section: $$amount_section | {$transaction->paymentType->name} | {$cat_name}$description ";
}

function daily_transaction_details($transaction){
    $amount_section =  $transaction->amount; //get_trans_amount($transaction, '$');
    $description = !empty($transaction->description) ? ' - ' . $transaction->description : '';

    $cat_name =  $transaction->budgetCategory->name;

    return "$$amount_section | {$transaction->paymentType->name} | {$cat_name}$description ";
}

function get_old_payment_type_data($paymentType){
    $paymentType->name = !empty( old('name' ) ) ? old('name') : $paymentType->name;
    $paymentType->description = !empty( old('description' ) ) ? old('description'): $paymentType->description;


    return $paymentType;
}

//transform date to datestring
function to_datestring($date){
    return Carbon::create($date)->toDateString();
}

//pass in date string - returns datetime
function create_datetime($date){
    $time = Carbon::now()->isoFormat('HH:mm:ss');
    return Carbon::create($date)->toDateString() . ' ' . $time;
}
