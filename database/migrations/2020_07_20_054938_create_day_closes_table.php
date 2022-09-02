<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayClosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_closes', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->float('cashinvoice')->default(0);
            $table->float('creditinvoice')->default(0);
            $table->float('salereturn')->default(0);
            $table->float('purchase')->default(0);
            $table->float('grn')->default(0);
            $table->float('purchasereturn')->default(0);
            $table->float('supplierpayment')->default(0);
            $table->float('creditpayment')->default(0);
            $table->float('expenses')->default(0);
            $table->float('stockamount')->nullable();
            $table->float('income')->default(0);
            $table->float('profit')->default(0);
            $table->float('cashin')->default(0);
            $table->float('cashout')->default(0);
            $table->float('cashdrawer')->default(0);
            $table->float('cashinbank')->default(0);
            $table->float('status')->default(1);
            $table->float('user_id');
            $table->tinyInteger('type');
            $table->string('month')->nullable();
            $table->Integer('year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('day_closes');
    }
}
