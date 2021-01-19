<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_no');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('policy_no');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('sub_class_id');
            $table->string('insurance_claim_no')->nullable();
            $table->dateTime('notification_date')->nullable();
            $table->dateTime('loss_date')->nullable();
            $table->integer('currency_id')->nullable()->default(1);
            $table->double('estimated_claim_amount')->default(0);
            $table->unsignedBigInteger('insurance_company')->nullable();
            $table->text('claim_description')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->nullable()->comment('0=pending; 1=approved; 2=declined');
            $table->unsignedBigInteger('submitted_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('claims');
    }
}
