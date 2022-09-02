<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashDrawersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_drawers', function (Blueprint $table) {
            $table->id();
            $table->string('inputdate');
            $table->float('cashin');
            $table->float('cashout');
            $table->float('balance');
            $table->integer('payment_id');
            $table->string('type');
            $table->tinyInteger('type_id')->nullable();
            $table->integer('user_id');
            $table->timestamps();
            $table->tinyinteger('cancel')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_drawers');
    }
}
