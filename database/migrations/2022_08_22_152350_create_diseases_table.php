<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('parent')->default(0);
            $table->string('flag')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->unsignedInteger('trending')->nullable()->default(0);
            $table->string('urdu_title', 45)->nullable();
            $table->text('urdu_decription')->nullable();
            $table->text('speciality_id')->nullable();
            $table->string('meta_key')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diseases');
    }
}
