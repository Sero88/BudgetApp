<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RecurringTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //past
        DB::table('recurring_transactions')->insert([
            'name' => 'past test',
            'amount' => 100.00,
            'day_of_month' => Carbon::create('yesterday')->toDateString(),
            'interval_id' => 1, //daily
            'transaction_type' => 1,
            'budget_cat_id' => 1,
            'sub_budget_category_id' => 1,
            'owner_id' => 1,
            'description' => 'past recurring transactions',
            'payment_type_id' => 1

        ]);

        //today
        DB::table('recurring_transactions')->insert([
            'name' => 'test',
            'amount' => 100.00,
            'day_of_month' => Carbon::now()->toDateString(),
            'interval_id' => 4, //monthly
            'transaction_type' => 1,
            'budget_cat_id' => 1,
            'owner_id' => 1,
            'description' => 'testing recurring trans',
            'payment_type_id' => 1

        ]);

        //future
        DB::table('recurring_transactions')->insert([
            'name' => 'test 2',
            'amount' => 1500,
            'day_of_month' =>  Carbon::create('tomorrow')->toDateString(),
            'interval_id' => 3, //biweekly
            'transaction_type' => 2,
            'budget_cat_id' => 1,
            'owner_id' => 1,
            'description' => 'testing debit recurring trans',
            'payment_type_id' => 1
        ]);
    }
}
