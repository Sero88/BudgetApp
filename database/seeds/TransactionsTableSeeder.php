<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::Table('transactions')->insert([
            'amount' => 100,
            'type_id' => 1,
            'budget_cat_id' => 1,
            'owner_id' => 1,
            'description' => 'testing seeder transaction',
            'date_made' => now(),
            'recurring_trans_id' => 1,
            'payment_type_id' => 1
        ]);

        DB::Table('transactions')->insert([
            'amount' => 200,
            'type_id' => 1,
            'budget_cat_id' => 1,
            'owner_id' => 1,
            'description' => 'testing seeder transaction 2',
            'date_made' => now(),
            'payment_type_id' => 1
        ]);

        DB::Table('transactions')->insert([
            'amount' => 100,
            'type_id' => 2,
            'budget_cat_id' => 1,
            'sub_budget_category_id' => 1,
            'owner_id' => 1,
            'description' => 'Debit. Testing seeder transaction 3',
            'date_made' => now(),
            'payment_type_id' => 1
        ]);

        DB::Table('transactions')->insert([
            'amount' => 100,
            'type_id' => 2,
            'budget_cat_id' => 2,
            'owner_id' => 1,
            'description' => 'Debit - last month',
            'date_made' => Carbon::now()->firstOfMonth()->subMonth(1)->toDateString(),
            'payment_type_id' => 1
        ]);

        DB::Table('transactions')->insert([
            'amount' => 250,
            'type_id' => 1,
            'budget_cat_id' => 2,
            'owner_id' => 1,
            'description' => 'Credit. Last month transaction',
            'date_made' => Carbon::now()->firstOfMonth()->subMonth(1)->toDateString(),
            'payment_type_id' => 1
        ]);

        DB::Table('transactions')->insert([
            'amount' => 150,
            'type_id' => 1,
            'budget_cat_id' => 1,
            'sub_budget_category_id' => 1,
            'owner_id' => 1,
            'description' => 'Debit. Testing seeder transaction 3',
            'date_made' => now(),
            'payment_type_id' => 1
        ]);

        DB::Table('transactions')->insert([
            'amount' => 300,
            'type_id' => 1,
            'budget_cat_id' => 3,
            'owner_id' => 1,
            'description' => 'Transaction with no sub budget cats',
            'date_made' => Carbon::now()->firstOfMonth()->subMonth(1)->toDateString(),
            'payment_type_id' => 1
        ]);

        DB::Table('transactions')->insert([
            'amount' => 100,
            'type_id' => 1,
            'budget_cat_id' => 3,
            'owner_id' => 1,
            'description' => 'Transaction two months back',
            'date_made' => Carbon::now()->firstOfMonth()->subMonth(2)->toDateString(),
            'payment_type_id' => 1
        ]);
    }
}
