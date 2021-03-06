<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(BalancesTableSeeder::class);
         $this->call(BudgetCategoriesTableSeeder::class);
         $this->call(SubBudgetCategoriesTableSeeder::class);
         $this->call(PaymentTypesSeeder::class);
         $this->call(RecurringTransactionSeeder::class);
         $this->call(TransactionsTableSeeder::class);

    }
}
