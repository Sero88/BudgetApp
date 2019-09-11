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
    /*"budget_cat" => array:2 [▼
        0 => "test"
        1 => "ers"
      ]
      "budget_cat_amount" => array:2 [▼
        0 => "213"
        1 => "343"
      ]
      "budget_cat_description" => array:2 [▼
        0 => "test"
        1 => "test"


    $new_cat['name'] = $user_input['budget_cat'][$i];
            $new_cat['description'] = !empty($user_input['budget_cat_description'][$i]) ? $user_input['budget_cat_description'][$i] : '';
            $new_cat['budget'] = $user_input['budget_cat_amount'][$i];
            $new_cat['balance_id'] = $new_balance->id;*/
}
