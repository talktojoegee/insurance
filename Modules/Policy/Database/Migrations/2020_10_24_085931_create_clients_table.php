<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('insured_name');
            $table->string('email');
            $table->string('password');
            $table->string('mobile_no')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->string('transaction_password')->nullable();
            $table->string('avatar')->nullable()->default('avatar.png');
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
        Schema::dropIfExists('clients');
    }
}
