<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('symbol', 10);
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('user_id')->references('id')->on('users');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_stocks');
    }
}
