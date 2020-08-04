<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use \App\Transaction;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecurringTransaction extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    public $timestamps = false;

    public function transactionType(){
        return $this->belongsTo(TransactionType::class, 'transaction_type');
    }

    public function transactionInterval(){
        return $this->belongsTo(TransactionInterval::class, 'interval_id');
    }

    public function budgetCategory(){
        return $this->belongsTo(BudgetCategory::class, 'budget_cat_id');
    }

    public function transactions(){
        return $this->hasMany(Transaction::class, 'recurring_trans_id');
    }

    public function subBudgetCategory(){
        return $this->belongsTo(SubBudgetCategory::class, 'sub_budget_category_id');
    }

    public function paymentType(){
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function upcomingTransactions(){

        return $this->where('day_of_month', '<=', Carbon::now()->toDateString())->get();
    }

    public function executeRecurringTransactions($transactions) {

        foreach($transactions as $trans){
            $data = [
                'amount' => $trans->amount,
                'type_id' => $trans->transaction_type,
                'budget_cat_id' => $trans->budget_cat_id,
                'sub_budget_category_id' => $trans->sub_budget_category_id,
                'owner_id' => $trans->owner_id,
                'description' => $trans->description,
                'date_made' => create_datetime($trans->day_of_month),
                'payment_type_id' => $trans->payment_type_id,
                'recurring_trans_id' => $trans->id
            ];


            //create transaction
            Transaction::createTransaction($data);

            //update the date of the recurring transaction
            $new_date = Carbon::create($trans->day_of_month)->add($trans->transactionInterval->amount, $trans->transactionInterval->unit)->toDateString();
            $trans->update( ['day_of_month' => $new_date] );

        }
    }
}
