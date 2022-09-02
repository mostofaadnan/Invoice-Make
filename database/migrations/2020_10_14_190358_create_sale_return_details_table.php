<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleReturnDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_return_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("retun_id");
            $table->integer("item_id");
            $table->float("mrp");
            $table->float("tp");
            $table->tinyinteger("unit_id");
            $table->float("qty");
            $table->float("amount");
            $table->float("vat");
            $table->float("discount");
            $table->float("nettotal");
            $table->timestamps();
            $table->foreign('retun_id')
                ->references('id')
                ->on('sale_returns')
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
        Schema::dropIfExists('sale_return_details');
    }
}
