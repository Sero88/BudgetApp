<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTransactionTypesValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('transaction_types')
            ->where('name', '=', 'expense')
            ->update(['name' => 'expense']
        );

        DB::table('transaction_types')
            ->where('name', '=', 'income')
            ->update(['name' => 'income']
        );

        DB::table('transaction_types')->insert([
                'name' => 'investment',
            ]
        );

        DB::table('transaction_types')->insert([
                'name' => 'saving',
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
        //
    }
}
