<?php

use Illuminate\Database\Seeder;

class BalancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('balances')->insert([
            'name' => 'Testing Balance',
            'description' => 'For testing purposes only',
            'amount' => 10000,
            'owner_id'=> 1
        ]);
    }
}
