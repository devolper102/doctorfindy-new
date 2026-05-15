<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffairDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affair_details', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('affairs_id')->nullable();
            $table->string('title', 250)->nullable();
            $table->string('type', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('url', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('image', 50)->nullable();
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
        Schema::dropIfExists('affair_details');
    }
}
