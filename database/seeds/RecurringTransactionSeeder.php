<?php

use Illuminate\Database\Seeder;

class RecurringTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recurring_transactions')->insert([
            'name' => 'test',
            'amount' => 100.00,
            'day_of_month' => '2019-10-15',
            'interval_id' => 4, //monthly
            'transaction_type' => 1,
            'budget_cat_id' => 1,
            'owner_id' => 1,
            'description' => 'testing recurring trans',
            'payment_type_id' => 1

        ]);

        DB::table('recurring_transactions')->insert([
            'name' => 'test 2',
            'amount' => 1500,
            'day_of_month' => '2019-10-15',
            'interval_id' => 3, //biweekly
            'transaction_type' => 2,
            'budget_cat_id' => 1,
            'owner_id' => 1,
            'description' => 'testing debit recurring trans',
            'payment_type_id' => 1
        ]);
    }
}
