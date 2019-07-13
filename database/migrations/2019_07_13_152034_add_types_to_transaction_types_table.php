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
