<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurringTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurring_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('amount',8,2)->unsigned();
            $table->date('day_of_month');
            $table->unsignedBigInteger('interval_id');
            $table->unsignedBigInteger('transaction_type');
            $table->unsignedBigInteger('budget_cat_id');
            $table->unsignedBigInteger('owner_id');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('interval_id')->references('id')->on('transaction_intervals');
            $table->foreign('transaction_type')->references('id')->on('transaction_types');
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
        Schema::dropIfExists('recurring_transactions');
    }
}
