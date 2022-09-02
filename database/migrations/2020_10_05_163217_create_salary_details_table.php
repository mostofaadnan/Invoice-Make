<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salary_id');
            $table->string('employee_id');
            $table->string('from_date');
            $table->string('to_date');
            $table->float('salary');
            $table->float('over_time');
            $table->float('bonus');
            $table->float('reduction');
            $table->float('netsalary');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('salary_id')
                ->references('id')
                ->on('salaries')
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
        Schema::dropIfExists('salary_details');
    }
}
