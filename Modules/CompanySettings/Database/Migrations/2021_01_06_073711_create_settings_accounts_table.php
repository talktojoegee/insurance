<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('transaction')->nullable();
            $table->unsignedBigInteger('debit_note_dr')->nullable();
            $table->unsignedBigInteger('cr')->nullable();
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
        Schema::dropIfExists('settings_accounts');
    }
}
