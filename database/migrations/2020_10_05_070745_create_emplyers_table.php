<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmplyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emplyers', function (Blueprint $table) {
            $table->id();
            $table->string('employer_id');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('mobile_no');
            $table->string('email');
            $table->text('education_background')->nullable();
            $table->string('job_type');
            $table->string('designation')->nullable();
            $table->string('salary_basis');
            $table->Integer('salary');
            $table->string('joining_date');
            $table->string('image');
            $table->text('other_description')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('emplyers');
    }
}
