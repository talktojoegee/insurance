<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('policy_no');
            $table->integer('cover_type');
            $table->string('reg_no');
            $table->integer('state_issued');
            $table->integer('vehicle_make');
            $table->string('engine_no');
            $table->string('chassis_no');
            $table->double('vehicle_value');
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
        Schema::dropIfExists('vehicle_infos');
    }
}
