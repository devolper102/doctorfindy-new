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
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->integer('location_id')->nullable();
            $table->string('verification_code')->nullable();
            $table->boolean('user_verified')->nullable();
            $table->string('package_expiry')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('phone_number')->nullable();
            $table->string('assistant_phone_number')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->dateTime('exceed_time')->nullable();
            $table->string('select_degree', 45)->nullable();
            $table->string('pmdc_number', 45)->nullable();
            $table->string('ncs_number', 45)->nullable();
            $table->integer('trending')->nullable();
            $table->integer('unique_id')->nullable();
            $table->string('total_discount_percentage', 45)->nullable();
            $table->string('admin_discount_percentage', 45)->nullable();
            $table->string('user_discount_percentage', 45)->nullable();
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
