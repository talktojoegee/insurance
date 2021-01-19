<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('glcode');
            $table->unsignedBigInteger('posted_by')->nullable();
            $table->string('narration')->nullable();
            $table->double('dr_amount')->default(0);
            $table->double('cr_amount')->default(0);
            $table->string('ref_no')->nullable();
            $table->tinyInteger('bank')->default(0)->nullable();
            $table->tinyInteger('ob')->default(0)->nullable()->comment('opening balance');
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
        Schema::dropIfExists('general_ledgers');
    }
}
