<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string("purchasecode");
            $table->string("ref_no")->nullable();
            $table->string("inputdate");
            $table->unsignedBigInteger('supplier_id');
            $table->string('supplier_name')->nullable();
            $table->float("amount");
            $table->float("discount");
            $table->float("vat");
            $table->float("nettotal");
            $table->float("shipment")->default(0)->nullable();
            $table->tinyinteger("status")->default(0);
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
        Schema::dropIfExists('purchases');
    }
}
