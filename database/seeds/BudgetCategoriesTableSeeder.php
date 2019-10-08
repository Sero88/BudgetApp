<?php

use Illuminate\Database\Seeder;

class BudgetCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('budget_categories')->insert([
            'name' => 'testCat #1',
            'budget' => 1000,
            'description' => 'Testing cat 1',
            'balance_id' => 1
        ]);
    }
}
