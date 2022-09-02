<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_returns', function (Blueprint $table) {
            $table->id();
            $table->string('return_no');
            $table->string('invoice_id')->nullable();
            $table->string('inputdate');
            $table->string("ref_no")->nullable();
            $table->tinyinteger('type_id')->nullable();
            $table->integer('customer_id');
            $table->float("amount");
            $table->float("discount");
            $table->float("vat");
            $table->float("nettotal");
            $table->integer("user_id");
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
        Schema::dropIfExists('sale_returns');
    }
}
