<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesRemoveBudgetFromParentCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_budget_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->decimal('budget',8,2);
            $table->unsignedBigInteger('budget_category_id');
            $table->softDeletes();

            $table->foreign('budget_category_id')->references('id')->on('budget_categories');
        });

        Schema::table('budget_categories', function (Blueprint $table) {
            $table->dropColumn('budget');
            $table->dropColumn(['created_at', 'updated_at']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_budget_category_id')->nullable();
            $table->foreign('sub_budget_category_id')->references('id')->on('sub_budget_categories');
        });

        Schema::table('recurring_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_budget_category_id')->nullable();
            $table->foreign('sub_budget_category_id')->references('id')->on('sub_budget_categories');
        });

        Schema::table('balances', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });

        Schema::table('recurring_transactions', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });

        Schema::table('transaction_intervals', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories_remove_budget_from_parent_categories');
    }
}
