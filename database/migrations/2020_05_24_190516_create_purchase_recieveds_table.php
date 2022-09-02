<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRecievedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_recieveds', function (Blueprint $table) {
            $table->id();
            $table->string("purchaseRecievdNo");
            $table->unsignedBigInteger("purchase_id");
            $table->unsignedBigInteger("supplier_id");
            $table->string("inputdate");
            $table->text("remark")->nullable();
            $table->string("user_id");
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
        Schema::dropIfExists('purchase_recieveds');
    }
}
