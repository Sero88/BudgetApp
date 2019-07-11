<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',25);
            $table->text('description');
            $table->decimal('budget',8,2);
            $table->unsignedBigInteger('balance_id');
            $table->timestamps();

            $table->foreign('balance_id')->references('id')->on('balances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_categories');
    }
}
