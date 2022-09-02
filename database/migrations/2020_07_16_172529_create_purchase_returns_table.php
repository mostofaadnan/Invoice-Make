<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->id();
            $table->string("return_code");
            $table->string("purchasecode")->nullable();
            $table->string("ref_no")->nullable();
            $table->string("inputdate");
            $table->string("supplier_id");
            $table->float("amount");
            $table->float("discount");
            $table->float("vat");
            $table->float("nettotal");
            $table->text("remark")->nullable();
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
        Schema::dropIfExists('purchase_returns');
    }
}
