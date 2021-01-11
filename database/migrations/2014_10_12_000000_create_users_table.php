<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employment_type')->default(1)->nullable(); //0=probation
            $table->unsignedBigInteger('state')->nullable();
            $table->unsignedBigInteger('lga')->nullable();
            $table->integer('marital_status')->nullable();
            $table->integer('blood_group')->nullable();
            $table->integer('genotype')->nullable();
            $table->integer('grade')->nullable();
            $table->integer('role')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('other_names')->nullable();
            $table->string('email')->unique();
            $table->string('official_email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('employee_id')->nullable();
            $table->tinyInteger('gender')->default(1)->nullable(); //1=male, 2=female
            $table->string('username')->nullable();
            $table->string('known_ailment')->nullable();
            $table->tinyInteger('account_status')->default(1)->nullable(); //1=active
            $table->unsignedBigInteger('active_theme')->default(1)->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->dateTime('hire_date')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('confirm_date')->nullable();
            $table->unsignedBigInteger('department')->nullable();
            $table->unsignedBigInteger('job_role')->nullable();
            $table->string('avatar')->default('avatar.png')->nullable();
            $table->string('cover')->default('cover.png')->nullable();
            $table->string('url')->nullable();
            $table->string('transaction_password')->nullable();
            $table->string('verification_link')->nullable();
            $table->tinyInteger('verified')->default(0)->nullable(); //if yes = 1;
            $table->timestamp('last_seen')->nullable();;
            $table->tinyInteger('is_online')->default(0)->nullable(); //0=offline, 1=online
            $table->tinyInteger('visibility')->default(1)->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('users');
    }
}
