<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('title', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('speciality_id', 255)->nullable();
            $table->timestamps();
            $table->string('price', 45)->nullable();
            $table->string('discounted_price', 45)->nullable();
            $table->text('known_as')->nullable();
            $table->string('lab_id', 45)->nullable();
            $table->string('lab_testscol', 255)->nullable();
            $table->string('lab_link_id', 255)->nullable();
            $table->string('averagePrice', 255)->nullable();
            $table->string('sample_type', 255)->nullable();
            $table->string('turn_around_time', 255)->nullable();
            $table->string('sample_requirement', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_tests');
    }
}
