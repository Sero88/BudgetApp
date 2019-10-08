<?php

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
            'date_made' => now()
        ]);
    }
}
