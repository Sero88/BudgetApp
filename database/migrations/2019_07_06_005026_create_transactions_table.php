<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount',8,2);
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('budget_cat_id');
            $table->dateTime('date_made');

            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('transaction_types');
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
        Schema::dropIfExists('transactions');
    }
}
