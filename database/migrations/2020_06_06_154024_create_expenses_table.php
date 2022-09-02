<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expenses_no');
            $table->integer('expenses_id');
            $table->string('inputdate');
            $table->float('amount');
            $table->text('description')->nullable();
            $table->integer('payment_type');
            $table->text('payment_description')->nullable();
            $table->string('voucherno')->nullable();
            $table->integer('user_id');
            $table->timestamps();
            $table->tinyInteger('void')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
