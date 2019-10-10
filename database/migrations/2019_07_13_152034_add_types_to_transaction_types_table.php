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
                'name' => 'credit',
            ]
        );

        DB::table('transaction_types')->insert([
                'name' => 'debit',
            ]
        );

        DB::table('transaction_intervals')->insert([
            'name' => 'daily',
            'days_amount' => 1
        ]);

        DB::table('transaction_intervals')->insert([
            'name' => 'weekly',
            'days_amount' => 7
        ]);

        DB::table('transaction_intervals')->insert([
            'name' => 'biweekly',
            'days_amount' => 14
        ]);

        DB::table('transaction_intervals')->insert([
            'name' => 'monthly',
            'days_amount' => 30
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('transaction_types')->where(['name'=>'credit'])->orWhere(['name' => 'debit'])->delete();
    }
}
