<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedureEstimatedCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_estimated_costs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('first_name', 150)->nullable();
            $table->string('last_name', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('dob', 150)->nullable();
            $table->string('procedure_id', 150)->nullable();
            $table->string('phone_number', 150)->nullable();
            $table->string('hospital_id', 150)->nullable();
            $table->string('status', 150)->nullable();
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
        Schema::dropIfExists('procedure_estimated_costs');
    }
}
