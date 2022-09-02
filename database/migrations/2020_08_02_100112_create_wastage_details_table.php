<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWastageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wastage_details', function (Blueprint $table) {
            $table->id();
            $table->integer("wastage_id");
            $table->integer("item_id");
            $table->float("tp");
            $table->tinyinteger("unit_id");
            $table->float("qty");
            $table->float("amount");
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
        Schema::dropIfExists('wastage_details');
    }
}
