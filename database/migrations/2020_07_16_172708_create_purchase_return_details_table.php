<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseReturnDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_return_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("return_id");
            $table->integer("itemcode");
            $table->float("mrp");
            $table->float("tp");
            $table->tinyinteger("unit_id");
            $table->float("qty");
            $table->float("amount");
            $table->float("vat");
            $table->float("discount");
            $table->float("nettotal");
            $table->timestamps();
            $table->foreign('return_id')
            ->references('id')
            ->on('purchase_returns')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_return_details');
    }
}
