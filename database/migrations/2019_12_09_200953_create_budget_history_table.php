<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('budget_cat_id');
            $table->tinyInteger('month');
            $table->year('year');
            $table->decimal('budget',8,2);

            $table->foreign('budget_cat_id')->references('id')->on('budget_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_history');
    }
}
