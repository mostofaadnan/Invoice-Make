<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('payment_no');
            $table->string('inputdate')->nullable();
            $table->string('from_date');
            $table->string('to_date');
            $table->float('total_salary');
            $table->float('total_over_time');
            $table->float('total_bonus');
            $table->float('total_reduction');
            $table->float('netsalary');
            $table->tinyInteger('payment_type');
            $table->string('payment_description');
            $table->tinyInteger('status')->default(0);
            $table->text('remark');
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
        Schema::dropIfExists('salaries');
    }
}
