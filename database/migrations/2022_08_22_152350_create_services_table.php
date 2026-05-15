<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('speciality_id')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->string('type')->nullable();
            $table->string('top', 45)->nullable();
            $table->unsignedInteger('trending')->nullable()->default(0);
            $table->string('image', 45)->nullable();
            $table->string('urdu_title', 45)->nullable();
            $table->text('urdu_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
