<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customerid');
            $table->string('name');
            $table->text('address')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('postalcode')->nullable();
            $table->text('TIN')->nullable();
            $table->tinyinteger('status')->nullable();
            $table->text('mobile_no')->nullable();
            $table->text('tell_no')->nullable();
            $table->text('fax_no')->nullable();
            $table->text('email')->nullable();
            $table->text('website')->nullable();
            $table->string('image')->nullable();
            $table->string('openingDate');
            $table->integer('user_id');
            $table->timestamps();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
