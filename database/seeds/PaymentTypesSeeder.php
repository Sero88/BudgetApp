<?php

use Illuminate\Database\Seeder;

class PaymentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('payment_types')->insert([
            'name' => 'Checking Account',
            'description' => 'Great Western Bank Checking account',
            'owner_id' => 1
        ]);

        DB::Table('payment_types')->insert([
            'name' => 'Credit Card',
            'description' => 'Credit card account',
            'owner_id' => 1
        ]);
    }
}
