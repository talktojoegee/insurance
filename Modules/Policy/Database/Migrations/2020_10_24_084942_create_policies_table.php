<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author')->comment('Person that registered this policy');
            $table->unsignedBigInteger('client_id')->comment('Insured Unique ID');
            $table->unsignedBigInteger('policy_number')->unique();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('sub_class_id');
            $table->unsignedBigInteger('agency_id');
            $table->string('insurance_policy_number');
            $table->tinyInteger('policy_type')->nullable()->comment('1=Non-motor, 2=motor');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->double('sum_insured')->default(0);
            $table->unsignedBigInteger('currency')->nullable();
            $table->tinyInteger('default_currency')->nullable()->comment("Company's default currency?");
            $table->double('exchange_rate')->default(1);
            $table->double('premium_rate')->default(0);
            $table->double('gross_premium')->default(0);
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
        Schema::dropIfExists('policies');
    }
}
