<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblOrderHistoryDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order_history_detail', function (Blueprint $table) {
            $table->increments('order_history_detail_id');
            $table->integer('order_history_id');
            $table->integer('product_id');
            $table->integer('product_sales_quantity');
            $table->string('product_coupon',50);
            $table->string('product_feeship',50);
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
        Schema::dropIfExists('tbl_order_history_detail');
    }
}
