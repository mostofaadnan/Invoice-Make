<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarcodeConfigarationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode_configarations', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('companyshow');
            $table->tinyInteger('itemcodeshow');
            $table->tinyInteger('itemnameshow');
            $table->tinyInteger('itempriceshow');
            $table->tinyInteger('itemothernoteshow');
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
        Schema::dropIfExists('barcode_configarations');
    }
}
