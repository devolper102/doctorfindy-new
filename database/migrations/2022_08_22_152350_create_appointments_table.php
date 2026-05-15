<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('hospital_id');
            $table->integer('online_id')->nullable();
            $table->integer('patient_id');
            $table->string('patient_name')->nullable();
            $table->enum('relation', ['father', 'mother', 'sister', 'brother', 'friend'])->nullable();
            $table->text('services')->nullable();
            $table->text('comments')->nullable();
            $table->string('appointment_time');
            $table->string('appointment_date');
            $table->integer('charges');
            $table->string('status');
            $table->timestamps();
            $table->string('type')->nullable();
            $table->string('follow_up', 45)->nullable();
            $table->string('booked', 45)->nullable();
            $table->string('direct_booking', 45)->nullable();
            $table->string('notes', 45)->nullable();
            $table->string('status_action', 45)->nullable();
            $table->string('payment', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
