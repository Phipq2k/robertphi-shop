<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPaymentVnpay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payment_vnpay', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->integer('payment_transaction_id')->nullable();
            $table->integer('payment_user_id');
            $table->float('payment_money')->comment('Số tiền thanh toán');
            $table->string('payment_note')->nullable()->comment('Nội dung thanh toán');
            $table->string('payment_vnpay_response_code',255)->nullable()->comment('Mã phản hồi');
            $table->string('payment_code_vnpay',255)->nullable()->comment('Mã giao dịch VNPay');
            $table->string('payment_code_bank',255)->nullable()->comment('Mã ngân hàng');
            $table->dateTime('payment_time')->nullable()->comment('Thời gian chuyển khoản');
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
        Schema::dropIfExists('tbl_payment_vnpay');
    }
}
