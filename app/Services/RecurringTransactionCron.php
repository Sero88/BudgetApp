<?php


namespace App\Services;
use App\RecurringTransaction;

class RecurringTransactionCron
{
    public function executeTransactions(){
        //check if there are any upcoming
        $trans = RecurringTransaction::upcomingTransactions;

        dd($trans);

    }
}
