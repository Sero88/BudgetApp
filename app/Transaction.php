<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    use SoftDeletes;

    public function budgetCategory(){
        return $this->belongsTo(BudgetCategory::class, 'budget_cat_id');
    }

    public function subBudgetCategory(){
        return $this->belongsTo(SubBudgetCategory::class, 'sub_budget_category_id');
    }

    public function transactionType(){
        return $this->belongsTo(TransactionType::class, 'type_id');
    }

    // this method doesn't seem to be working,
    public function balance(){
        return $this->hasOneThrough('\App\Balance', '\App\BudgetCategory', 'balance_id', 'id');
    }

    public function recurringTransaction(){
        return $this->belongsTo(RecurringTransaction::class, 'recurring_trans_id');
    }

    public function paymentType(){
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public static function createTransaction($transaction){

        $savedTrans = Transaction::create($transaction);

        //get its corresponding balance
        $balance = $savedTrans->budgetCategory->balance;

        //update balance with transaction
        $balance->balanceUpdate($savedTrans);

        return $savedTrans;
    }

    public static function deleteTransaction($transaction){
        //get its corresponding balance
        $balance = $transaction->budgetCategory->balance;

        //update balance with transaction
        $balance->balanceUpdate($transaction, 'delete');

        return $transaction->delete();
    }

}
