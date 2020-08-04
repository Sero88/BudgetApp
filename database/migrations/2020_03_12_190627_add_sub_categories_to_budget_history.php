<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubCategoriesToBudgetHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budget_history', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_budget_category_id')->nullable();
            $table->foreign('sub_budget_category_id')->references('id')->on('sub_budget_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budget_history', function (Blueprint $table) {
            //
        });
    }
}
