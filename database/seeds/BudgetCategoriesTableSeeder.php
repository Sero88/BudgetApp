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
            'description' => 'Testing cat 1',
            'balance_id' => 1
        ]);

        DB::Table('budget_categories')->insert([
            'name' => 'testCat #2',
            'description' => 'Testing cat 2',
            'balance_id' => 1
        ]);

        DB::Table('budget_categories')->insert([
            'name' => 'testCat #3',
            'description' => 'No sub budget categories',
            'balance_id' => 1
        ]);
    }
}
