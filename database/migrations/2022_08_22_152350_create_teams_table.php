<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 45);
            $table->integer('doctor_id');
            $table->text('slots')->nullable();
            $table->text('online_slots')->nullable();
            $table->string('message');
            $table->enum('status', ['pending', 'approved', 'cancelled'])->default('pending');
            $table->integer('price')->nullable()->default(0);
            $table->integer('video_consultation_price')->nullable()->default(0);
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
        Schema::dropIfExists('teams');
    }
}
