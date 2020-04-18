<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypesToTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::table('transaction_types')->insert([
                'name' => 'expense',
            ]
        );

        DB::table('transaction_types')->insert([
                'name' => 'income',
            ]
        );

        DB::table('transaction_intervals')->insert([
            'name' => 'daily',
            'amount' => 1,
            'unit' => 'day'
        ]);

        DB::table('transaction_intervals')->insert([
            'name' => 'weekly',
            'amount' => 1,
            'unit' => 'week'
        ]);

        DB::table('transaction_intervals')->insert([
            'name' => 'biweekly',
            'amount' => 2,
            'unit' => 'week'
        ]);

        DB::table('transaction_intervals')->insert([
            'name' => 'monthly',
            'amount' => 1,
            'unit' => 'month'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('transaction_types')->where(['name'=>'expense'])->orWhere(['name' => 'income'])->delete();
    }
}
