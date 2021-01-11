<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_generals', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('official_email')->nullable();
            $table->string('office_phone_1')->nullable();
            $table->string('office_phone_2')->nullable();
            $table->string('tagline')->nullable();
            $table->string('company_prefix')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('office_address')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_favicon')->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->text('privacy_policy')->nullable();
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
        Schema::dropIfExists('settings_generals');
    }
}
