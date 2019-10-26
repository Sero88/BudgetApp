<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use \App\Transaction;

class RecurringTransaction extends Model
{
    protected $guarded = [];

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

    public function upcomingTransactions(){

        return $this->where('day_of_month', '<=', Carbon::now()->toDateString())->get();
    }

    public function executeRecurringTransactions($transactions) {

        foreach($transactions as $trans){
            $data = [
                'amount' => $trans->amount,
                'type_id' => $trans->transaction_type,
                'budget_cat_id' => $trans->budget_cat_id,
                'owner_id' => $trans->owner_id,
                'description' => $trans->description,
                'date_made' => now(),
                'recurring_trans_id' => $trans->id
            ];

            //create transaction
            $newTrans = Transaction::createTransaction($data);

            //if transaction was successful, change day of next transaction based off of its interval
            if( !empty($newTrans->date_made) ) {
                $new_date = Carbon::create($trans->day_of_month)->add($trans->transactionInterval->amount, $trans->transactionInterval->unit)->toDateString();
                $trans->update( ['day_of_month' => $new_date] );
                return true;
            } else{
                return false;
            }
        }



    }
}
