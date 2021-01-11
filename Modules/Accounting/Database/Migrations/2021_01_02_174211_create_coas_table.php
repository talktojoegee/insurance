<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coas', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->tinyInteger('account_type');
            $table->tinyInteger('bank')->default(0);
            $table->unsignedBigInteger('glcode');
            $table->unsignedBigInteger('parent_account')->nullable();
            $table->tinyInteger('type')->default(0)->comment('1=General, 2=Detail');
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
        Schema::dropIfExists('coas');
    }
}
