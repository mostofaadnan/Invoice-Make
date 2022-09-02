<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarcodeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barcode_details', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('dimension');
            $table->string('width')->nullable();
            $table->string('heigh')->nullable();
            $table->text('companyname')->nullable();
            $table->text('othernote')->nullable();
            $table->string('itemcode');
            $table->text('itemname')->nullable();
            $table->integer('qty');
            $table->float('mrp')->nullable();
            $table->float('discount')->nullable();
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
        Schema::dropIfExists('barcode_details');
    }
}
