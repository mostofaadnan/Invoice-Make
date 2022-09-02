<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('inputdate');
            $table->float('cashin');
            $table->float('cashout');
            $table->float('balance');
            $table->text('bank');
            $table->text('accno');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('banks');
    }
}
