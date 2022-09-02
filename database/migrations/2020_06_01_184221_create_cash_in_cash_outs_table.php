<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashInCashOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_in_cash_outs', function (Blueprint $table) {
            $table->id();
            $table->string('payment_no');
            $table->string('type');
            $table->string('inputdate');
            $table->float('amount');
            $table->string('source');
            $table->text('remark')->nullable();
            $table->integer('user_id');
            $table->timestamps();
            $table->text('payment_description')->nullable();
            $table->tinyInteger('cancel')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_in_cash_outs');
    }
}
