<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUserReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_user_reviews', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('patient_id');
            $table->string('category')->nullable();
            $table->string('experience')->nullable();
            $table->string('detail')->nullable();
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_user_reviews');
    }
}
