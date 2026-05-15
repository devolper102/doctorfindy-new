<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinationLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccination_locations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('vaccination_id', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('hospital_id', 50)->nullable();
            $table->string('hospital_address', 50)->nullable();
            $table->string('room', 50)->nullable();
            $table->string('phone_no', 50)->nullable();
            $table->string('start_time', 50)->nullable();
            $table->string('end_time', 50)->nullable();
            $table->string('days')->nullable();
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
        Schema::dropIfExists('vaccination_locations');
    }
}
