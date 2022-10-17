<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblOrderHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tạo data
        Schema::create('tbl_order_history', function (Blueprint $table) {
            $table->increments('order_history_id');
            $table->integer('customer_id');
            $table->integer('shipping_id');
            $table->float('order_history_total');
            $table->integer('order_history_status');
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
        Schema::dropIfExists('tbl_order_history');
    }
}
