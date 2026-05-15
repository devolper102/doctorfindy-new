<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_notification', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('appointment_id')->nullable();
            $table->string('status')->default('unread');
            $table->string('to_display')->nullable();
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
        Schema::dropIfExists('appointment_notification');
    }
}
