<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('debit_code');
            $table->unsignedBigInteger('receipt_no');
            $table->tinyInteger('payment_mode')->default(1)->comment('1=Cash, 2=Bank Transfer, 3=Cheque');
            $table->tinyInteger('payment_type')->default(1)->comment('1=Full, 2=Installment/part');
            $table->double('amount')->default(0);
            $table->unsignedBigInteger('glcode');
            $table->unsignedBigInteger('currency_id')->default(1);
            $table->double('exchange_rate')->default(1);
            $table->tinyInteger('status')->default(0)->comment('0=unpaid, 1=paid');
            $table->string('transaction_id')->nullable();
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
        Schema::dropIfExists('receipts');
    }
}
