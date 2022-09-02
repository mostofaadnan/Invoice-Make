<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasedetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("purchase_id");
            $table->unsignedInteger("supplier_id");
            $table->integer("itemcode");
            $table->integer("item_name")->nullable();
            $table->float("mrp");
            $table->float("tp");
            $table->tinyinteger("unit_id");
            $table->float("qty");
            $table->float("amount");
            $table->float("vat");
            $table->float("discount");
            $table->float("nettotal");
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('purchase_id')
                ->references('id')
                ->on('purchases')
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
        Schema::dropIfExists('purchasedetails');
    }
}
