<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('waiting_time')->nullable();
            $table->text('rating')->nullable();
            $table->string('avg_rating')->nullable();
            $table->text('comment');
            $table->integer('patient_id');
            $table->string('keep_anonymous')->default('off');
            $table->timestamps();
            $table->string('user_id')->nullable();
            $table->integer('approval')->nullable();
            $table->string('type', 45)->nullable();
            $table->integer('procedure_id')->nullable();
            $table->integer('votes')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedbacks');
    }
}
