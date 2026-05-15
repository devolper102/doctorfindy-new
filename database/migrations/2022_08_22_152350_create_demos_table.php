<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 190)->nullable();
            $table->string('speciality', 190)->nullable();
            $table->string('pdmc_ncs_select', 190)->nullable();
            $table->string('number', 190)->nullable();
            $table->string('registration_number', 190)->nullable();
            $table->string('phone_number', 190)->nullable();
            $table->string('email', 190)->nullable();
            $table->string('city', 190)->nullable();
            $table->string('role', 190)->nullable();
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
        Schema::dropIfExists('demos');
    }
}
