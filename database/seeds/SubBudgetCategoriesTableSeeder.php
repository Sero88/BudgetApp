<?php

use Illuminate\Database\Seeder;

class SubBudgetCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('sub_budget_categories')->insert([
            'name' => 'sub cat testCat #1',
            'description' => 'sub cat of Testing cat 1',
            'budget' => 350,
            'budget_category_id' => 1
        ]);

        DB::Table('sub_budget_categories')->insert([
            'name' => 'sub cat testCat #2',
            'description' => 'sub cat of Testing cat 2',
            'budget' => 200,
            'budget_category_id' => 2
        ]);

        DB::Table('sub_budget_categories')->insert([
            'name' => 'sub cat testCat #3',
            'description' => 'sub cat of Testing cat 3',
            'budget' => 400,
            'budget_category_id' => 1
        ]);


    }
}
