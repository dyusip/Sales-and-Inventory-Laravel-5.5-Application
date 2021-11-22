<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_details', function (Blueprint $table) {
            $table->string('sd_no',25);
            $table->string('prod_code',25);
            $table->string('prod_name',150);
            $table->string('prod_os',255);
            $table->double('prod_price');
            $table->integer('prod_qty');
            $table->double('prod_total');
            $table->timestamps();

            $table->primary(['sd_no','prod_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_details');
    }
}
