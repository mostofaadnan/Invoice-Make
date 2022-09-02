<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_debts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->float('openingBalance')->default(0);
            $table->float('consignment')->default(0);
            $table->float('totaldiscount')->default(0);
            $table->float('returnamount')->default(0)->nullable();
            $table->float('payment')->default(0);
            $table->text('remark')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('trn_id');
            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
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
        Schema::dropIfExists('supplier_debts');
    }
}
