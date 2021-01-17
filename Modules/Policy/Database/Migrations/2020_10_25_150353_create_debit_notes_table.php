<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebitNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debit_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('debit_code');
            $table->unsignedBigInteger('policy_no');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->integer('business_type')->default(1)->comment('1=New, 2=additional, 3=Renewal, 4=return, 5=reversal');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('option')->nullable()->comment('1=Direct, 2=co-broking, 3=Lead-broking, 4=outward reinsurance, 5=inward reinsurance');
            $table->string('narration')->nullable();
            $table->integer('currency')->nullable();
            $table->double('exchange_rate')->nullable()->default(1);
            $table->double('sum_insured')->nullable();
            $table->double('premium_rate')->nullable();
            $table->double('commission_rate')->nullable();
            $table->double('commission')->nullable();
            $table->double('net_amount')->nullable()->default(0);
            $table->double('gross_premium')->nullable()->default(0);
            $table->double('vat')->nullable()->default(0);
            $table->integer('payment_mode')->nullable()->default(1)->comment('1=cash, 2=bank transfer, 3=cheque, 4=to be adviced');
            $table->string('reference_no')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('leave_note')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('debit_notes');
    }
}
