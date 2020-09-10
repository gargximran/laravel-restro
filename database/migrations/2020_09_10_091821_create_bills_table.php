<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->string("bill_id");
            $table->string('table_id')->nullable();
            $table->string('table_name');
            $table->integer('total');
            $table->integer('discount')->nullable();
            $table->integer('payable');
            $table->integer('vat')->nullable();
            $table->integer('service_charge')->nullable();
            $table->string('status');
            $table->string('user_id');
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
        Schema::dropIfExists('bills');
    }
}
